function uniqueElements(arr) {
    if (!Array.isArray(arr)) {
        console.log('Invalid input');
        return;
    }
    const result = {};
    for (let elt of arr) {
        if (typeof(elt) !== 'number' && typeof(elt) !== 'string') {
            console.log('Invalid input element');
            continue;
        }
        elt = "" + elt;
        if (elt in result) {
            result[elt] += 1;
        } else {
            result[elt] = 1;
        }
    }
    if (Object.keys(result).length === 0) {
        console.log('Empty input');
        return;
    }

    console.log(result);
}