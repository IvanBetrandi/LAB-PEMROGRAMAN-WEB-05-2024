
const readline = require('readline');


const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

const randomNumber = Math.floor(Math.random() * 100) + 1;
let percobaan = 0;

function tebakangka() {
  rl.question('Masukkan salah satu dari angka 1 sampai 100: ', (input) => {
    let tebak = parseInt(input);
    percobaan++;

    if (tebak > randomNumber) {
      console.log('Terlalu tinggi! Coba lagi.');
      tebakangka(); 
    } else if (tebak < randomNumber) {
      console.log('Terlalu rendah! Coba lagi.');
      tebakangka(); 
    } else if (tebak === randomNumber) {
      console.log(`Selamat! Kamu berhasil menebak angka ${randomNumber} dengan benar.`);
      console.log(`Sebanyak ${percobaan} percobaan.`);
      rl.close(); 
    } else {
      console.log('Input tidak valid. Masukkan angka antara 1 sampai 100.');
      tebakangka(); 
    }
  });
}

tebakangka();
