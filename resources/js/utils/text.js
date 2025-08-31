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
    if (symbol) {
        return iconMap[symbol] || symbol.toLowerCase();
    }
    return 'usdt';
};

export function getDomainName() {
    const domainName = "Casino.ndstudiotestdomain" //window.location.hostname.split('.').slice(0, -1).join('.');
    const name = domainName.charAt(0).toUpperCase() + domainName.slice(1);
    return name.length > 14 ? name.substring(0, 14) : name;
}
export function getDomain() {
    const domain = window.location.hostname;
    return domain.length > 14 ? domain.substring(0, 14) : domain;
}
