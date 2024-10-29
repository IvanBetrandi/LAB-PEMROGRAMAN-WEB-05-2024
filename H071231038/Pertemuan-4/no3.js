function hitungHari(hariAwal, jumlahHari) {
    let hari = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
    let hariAwalLower = hariAwal.toLowerCase();
    let indeksAwal = hari.indexOf(hariAwalLower);
    jumlahHari = parseInt(jumlahHari, 10);

    if (isNaN(jumlahHari)) {
        return 'Jumlah hari tidak valid';
    }

    let indeksHariAkhir = (indeksAwal + jumlahHari) % 7;
    return hari[indeksHariAkhir];
}

let hari = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];

let hariIni = prompt("Masukkan hari awal (Minggu, Senin, dst.): ");
let hariAwalLower = hariIni.toLowerCase();

if (hari.includes(hariAwalLower)) {
    let jumlahHariInput = prompt("Masukkan jumlah hari ke depan: ");
    const hasil = hitungHari(hariAwalLower, jumlahHariInput);
    console.log(hasil);
} else {
    console.log('Hari invalid');
}