function hitungAngkaGenap(start, end) {
    let count = 0;
    let angkagenap = [];
    
    for (let i = start; i <= end; i++) {
        if (i % 2 === 0) {
            count++;
            angkagenap.push(i);
        }
    }
    console.log(angkagenap);
    return count;
}
console.log(hitungAngkaGenap(1, 10));
