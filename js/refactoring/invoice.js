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
    let result = `Statement for ${invoice.customer}\n`;

    for (let perf of invoice.perfomances) {
        // 注文の内訳を出力
        result += ` ${playFor(perf).name}: ${usd(amountFor(pref))} (${perf.audience} seats)\n`;
    }
    let totalAmount = appleSauce();

    result += `Amount owed is ${usd(totalAmount())}\n`
    result += `You earned ${totalVolumeCredits()} credeits\n`;
    console.log(result);
    return result;
}

// 関数amountforは一度代入されるだけで更新されないので、呼び出し元で変数のインライン化を行う
function amountFor(aPerformance){
    // 一回の演目に対する料金を計算している箇所→関数の抽出
    let result = 0;
    switch (playFor(aPerformance).type) {
    case "tragedy":
        result = 40000;
        if (aPerformance.audience > 30) {
            result += 1000 * (aPerformance.audience - 30);
        }
        break;
    case "comedy":
        result =  30000;
        if (aPerformance.audience > 20) {
            result += 10000 + 500 * (aPerformance.audience - 20);
        }
        result += 300 * aPerformance.audience;
        break;
    default:
        throw new Error(`unknown type: ${playFor(aPerformance).type}`);
    }
    return result;
}

// メインの関数からplayという変数を削除して関数に切り出した
function playFor(invoice, plays){
    return plays[aPerformance.playID];
}

function volumeCreditsFor(pref){
    let volumeCredits = 0;
    volumeCredits += Math.max(perf.audience - 30, 0);
    if ('comedy' === playFor(perf).type) volumeCredits += Math.floor(perf.audience / 5);
    return volumeCredits;
}

function usd(aNumber){
    return new Intl.NumberFormat('en-US',
    {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    }).format(aNumber/100);
}
function totalVolumeCredits(){
    let volumeCredits = 0;
    for (let perf of invoice.performances) {
        volumeCredits += volumeCreditsFor(perf);
    }
    return volumeCredits;
}

function appleSauce(){
    let totalAmount = 0;
    for (let perf of invoice.perfomances){
        totalAmount += amountFor(perf);
    }
    return totalAmount;
}

function totalAmount(){
    let totalAmount = 0;
    for (let perf of invoice.perfomances){
        totalAmount += amountFor(perf);
    }
    return totalAmount;
}