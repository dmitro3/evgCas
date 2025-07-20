export function formatNumber(number) {
    if (number >= 1000) {
        return (number / 1000).toFixed(1).replace(/\.0$/, "") + "K";
    }
    return number.toString();
}

export function copyText(text) {
    navigator.clipboard.writeText(text);
}

export function getCryptoIcon(symbol) {
    const iconMap = {
        'BTC': 'btc',
        'ETH': 'eth',
        'USDTTRC20': 'usdt',
        'USDTERC20': 'usdt',
        'BNB': 'binance',
        'SOL': 'sol',
        'TRX': 'trx',
        'XRP': 'ripple'
    };
    return iconMap[symbol] || symbol.toLowerCase();
};