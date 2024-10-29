function hitungDiskon(harga, jenisBarang) {
    let diskon = 0;

    if (jenisBarang.toLowerCase() === 'elektronik') {
        diskon = 10;
    } else if (jenisBarang.toLowerCase() === 'pakaian') {
        diskon = 20;
    } else if (jenisBarang.toLowerCase() === 'makanan') {
        diskon = 5;
    }

    let hargaDiskon = harga - (harga * (diskon / 100));

    console.log(`Harga awal: Rp${harga}`);
    console.log(`Diskon: ${diskon}%`);
    console.log(`Harga setelah diskon: Rp${hargaDiskon}`);
}

let hargaBarang = parseFloat(prompt("Masukkan harga barang:"));
if (!isNaN(hargaBarang)) {  
    let jenisBarang = prompt("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya):");
    hitungDiskon(hargaBarang, jenisBarang);  
} else {
    console.log('Input Invalid');
}
