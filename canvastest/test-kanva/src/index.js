import React, { Component } from 'react';
import { render } from 'react-dom';
import { Stage, Layer, Rect, Star, Circle, Text } from 'react-konva';
import Konva from 'konva';

class RenderRect extends React.Component {
  state = {
    color: 'green'
  };
  handleClick = () => {
    this.setState({
      color: Konva.Util.getRandomColor()
    });
  };
  render() {
    return (
      <Rect
        x={100}
        y={100}
        width={500}
        height={500}
        fill={this.state.color}
        shadowBlur={5}
        onClick={this.handleClick}
      />
    );
  }
}

class RenderStar extends React.Component {
  render() {
    return (
      <Star
        x={50}
        y={50}
        numPoints={3}
        innerRadius={20}
        outerRadius={40}
        fill="#89b717"
        opacity={0.8}
        draggable
        rotation={Math.random() * 180}
        shadowColor="black"
        shadowBlur={10}
        shadowOpacity={0.6}
      />
    );
  }
}

class App extends Component {
  render() {
    // Stage is a div container
    // Layer is actual canvas element (so you may have several canvases in the stage)
    // And then we have canvas shapes inside the Layer
    return (
      <Stage width={window.innerWidth} height={window.innerHeight}>
        <Layer>
          <Text text="Try click on rect" />
          <RenderRect />
          <RenderStar />
        </Layer>
      </Stage>
    );
  }
}

render(<App />, document.getElementById('root'));
