function mapObject(obj, callback) {
    if (typeof(obj) !== 'object' || obj === null || Array.isArray(obj)) {
        console.log('invalid input');
        return;
    }
    if (typeof(callback) != 'function') {
        console.log('invalid callback');
        return;
    }
    let result = {}
    for (let key in obj) {
        result[key] = callback(obj[key]);
    }
    return result;
}