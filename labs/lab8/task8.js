function mapAndFilter(arr, map, filter) {
    if (!Array.isArray(arr)) {
        console.log('Invalid input');
        return;
    }
    if (typeof (map) != 'function' || typeof (filter) != 'function') {
        console.log('Invalid callbacks');
        return;
    }
    return arr.map(map).filter(filter);
}