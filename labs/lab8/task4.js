function mergeObjects(obj1, obj2) {
    if (typeof(obj1) !== 'object' || typeof(obj2) !== 'object') {
        console.log('invalid input');
        return;
    }
    if (obj1 === null || obj2 === null || Array.isArray(obj1) || Array.isArray(obj2)) {
        console.log('invalid input');
        return;
    }
    const result = {};
    for (let key in obj1) {
        result[key] = obj1[key];
    }
    for (let key in obj2) {
        result[key] = obj2[key];
    }
    if (Object.keys(result).length === 0) {
        console.log('empty input');
        return;
    }
    console.log(result);
}