import React, { useState, useRef } from "react";
import { render } from 'react-dom';
import ButtonGroup from "react-bootstrap/ButtonGroup";
import Button from "react-bootstrap/Button";
import { Stage, Layer } from "react-konva";
import Rectangle from "./Rectangle";
import Circle from "./Circle";

const App = () => {
  const [rectangles, setRectangles] = useState([]);
  const [circles, setCircles] = useState([]);
  const [selectedId, selectShape] = useState(null);
  const [shapes, setShapes] = useState([]);
  const [, updateState] = React.useState();
  const stageEl = React.createRef();
  const layerEl = React.createRef();
  const getRandomInt = max => {
    return Math.floor(Math.random() * Math.floor(max));
  };

  const addRectangle = () => {
    const rect = {
      x: getRandomInt(100),
      y: getRandomInt(100),
      width: 200,
      height: 50,
      fill: "red",
      id: `rect${rectangles.length + 1}`,
    };
    const rects = rectangles.concat([rect]);
    setRectangles(rects);
    const shs = shapes.concat([`rect${rectangles.length + 1}`]);
    setShapes(shs);
  };
  const addCircle = () => {
    const circ = {
      x: getRandomInt(200),
      y: getRandomInt(200),
      width: 50,
      height: 50,
      fill: "blue",
      id: `circ${circles.length + 1}`,
    };
    const circs = circles.concat([circ]);
    setCircles(circs);
    const shs = shapes.concat([`circ${circles.length + 1}`]);
    setShapes(shs);
  };
  const forceUpdate = React.useCallback(() => updateState({}), []);

  // const undo = () => {
  //   const lastId = shapes[shapes.length - 1];
  //   let index = circles.findIndex(c => c.id == lastId);
  //   if (index != -1) {
  //     circles.splice(index, 1);
  //     setCircles(circles);
  //   }
  //   index = rectangles.findIndex(r => r.id == lastId);
  //   if (index != -1) {
  //     rectangles.splice(index, 1);
  //     setRectangles(rectangles);
  //   }
  //   shapes.pop();
  //   setShapes(shapes);
  //   forceUpdate();
  // };
  document.addEventListener("keydown", ev => {
    if (ev.code == "Delete" || "Backspace") {
      let index = circles.findIndex(c => c.id == selectedId);
      if (index != -1) {
        circles.splice(index, 1);
        setCircles(circles);
      }
      index = rectangles.findIndex(r => r.id == selectedId);
      if (index != -1) {
        rectangles.splice(index, 1);
        setRectangles(rectangles);
      }
      forceUpdate();
    }
  });
    // Stage is a div container
    // Layer is actual canvas element (so you may have several canvases in the stage)
    // And then we have canvas shapes inside the Layer
    return (
    <>
      <ButtonGroup>
        <Button variant="secondary" onClick={addRectangle}>
          四角形
        </Button>
        <Button variant="secondary" onClick={addCircle}>
          丸
        </Button>
        {/* <Button variant="secondary" onClick={undo}>
          Undo
        </Button> */}
      </ButtonGroup>
      <div style={{"width": "600px"}}>
        <Stage
          width={600}
          height={600}
          style={{"borderStyle": "solid"}}
          ref={stageEl}
          onMouseDown={e => {
            // deselect when clicked on empty area
            const clickedOnEmpty = e.target === e.target.getStage();
            if (clickedOnEmpty) {
              selectShape(null);
            }
          }}
        >
          <Layer ref={layerEl}>
            {rectangles.map((rect, i) => {
              return (
                <Rectangle
                  key={i}
                  shapeProps={rect}
                  isSelected={rect.id === selectedId}
                  onSelect={() => {
                    selectShape(rect.id);
                  }}
                  onChange={newAttrs => {
                    const rects = rectangles.slice();
                    rects[i] = newAttrs;
                    setRectangles(rects);
                  }}
                />
              );
            })}
            {circles.map((circle, i) => {
              return (
                <Circle
                  key={i}
                  shapeProps={circle}
                  isSelected={circle.id === selectedId}
                  onSelect={() => {
                    selectShape(circle.id);
                  }}
                  onChange={newAttrs => {
                    const circs = circles.slice();
                    circs[i] = newAttrs;
                    setCircles(circs);
                  }}
                />
              );
            })}
          </Layer>
        </Stage>
      </div>
    </>
  );
}

render(<App />, document.getElementById('root'));
