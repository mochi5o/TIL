alert('ok');
const invoice = [
    {
        "customer": "BigCo",
        "perfomances": [
            {
                "playID": "hamlet",
                "audience": 55
            },
            {
                "playID": "as-like",
                "audience": 35
            },
            {
                "playID": "othello",
                "audience": 40
            }
        ]
    }
];
const plays = {
    "hamlet":
    {
        "name": "Hamlet",
        "type": "tragedy"
    },
    "as−like":
    {
        "name": "As You Like It",
        "type": "comedy"
    },
    "othello":
    {
        "name": "Othello",
        "type": "tragedy"
    }
};

function statement (invoice, plays) {
    let totalAmount = 0;
    let volumeCredits = 0;
    let result = `Statement for ${invoice.customer}\n`;

    const format = new Intl.NumberFormat('en-US',
                            {
                                style: 'currency',
                                currency: 'USD',
                                minimumFractionDigits: 2
                            }).format;

    for (let perf of invoice.perfomances[0]) {
        const play = plays[perf.playID];
        let thisAmount = 0;

        switch (play.type) {
        case "tragedy":
            thisAmount = 40000;
            if (perf.audience > 30) {
                thisAmount += 1000 * (perf.audience - 30);
            }
            break;
        case "comedy":
            thisAmount =  30000;
            if (perf.audience > 20) {
                thisAmount += 10000 + 500 * (perf.audience - 20);
            }
            thisAmount += 300 * perf.audience;
            break;
        default:
            throw new Error(`unknown type: ${play.type}`);
        }
        //ボリューム特典のポイントを加算する
        volumeCredits += Math.max(perf.audience - 30, 0);
        // 喜劇の時は10人につきさらにポイントを追加
        if ("comedy" == play.type) volumeCredits += Math.floor(perf.audience / 5);
        // 注文の内訳を出力
        result += ` ${play.name}: ${format(thisAmount/100)} (${perf.audience} seats)\n`;
        totalAmount += thisAmount;
    }
    result += `Amount owed is ${format(totalAmount/100)}\n`
    result += `You earned ${volumeCredits} credeits\n`;
    return result;
}