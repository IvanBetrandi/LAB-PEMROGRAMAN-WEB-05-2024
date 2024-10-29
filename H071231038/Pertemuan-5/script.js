let playerCards = [];
let botCards = [];
let playerTotal = 0;
let botTotal = 0;
let playerMoney = 5000;  
let betAmount = 0;  
let gameStarted = false;
let gameOver = false;
let deck = [];

const botTotalDisplay = document.getElementById('botTotal');
const playerTotalDisplay = document.getElementById('playerTotal');
const moneyDisplay = document.getElementById('money');
const currentBetDisplay = document.getElementById('currentBet');
const botCardDiv = document.getElementById('botCard');
const playerCardsDiv = document.getElementById('playerCards');
const backcardImg = document.createElement('img'); 
backcardImg.src = 'Assets/Images/cards/BACK.png'; 

document.getElementById('startGame').addEventListener('click', startGame);
document.getElementById('hit').addEventListener('click', hit);
document.getElementById('stand').addEventListener('click', stand);

document.querySelectorAll('.chip').forEach(chip => {
    chip.addEventListener('click', function() {
        if (!gameStarted && !gameOver) {
            const betValue = parseInt(chip.getAttribute('data-value'));
            if (playerMoney >= betValue) {
                betAmount += betValue;
                playerMoney -= betValue;
                updateDisplay();
            } else {
                alert("Uang Tidak Cukup");
            }
        }
    });
});

function updateDisplay() {
    moneyDisplay.innerText = playerMoney;
    currentBetDisplay.innerText = betAmount;
    playerTotalDisplay.innerText = playerTotal;
    botTotalDisplay.innerText = gameStarted ? botCards[1].value : 0; 
}

function initializeDeck() {
    const suits = ["C", "D", "H", "S"];
    const values = [
        { name: "A", value: 11 },
        { name: "2", value: 2 },
        { name: "3", value: 3 },
        { name: "4", value: 4 },
        { name: "5", value: 5 },
        { name: "6", value: 6 },
        { name: "7", value: 7 },
        { name: "8", value: 8 },
        { name: "9", value: 9 },
        { name: "10", value: 10 },
        { name: "J", value: 10 },
        { name: "Q", value: 10 },
        { name: "K", value: 10 }
    ];
    deck = [];

    suits.forEach(suit => {
        values.forEach(value => {
            deck.push({ ...value, suit: suit });
        });
    });
}

function shuffleDeck() {
    for (let i = deck.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [deck[i], deck[j]] = [deck[j], deck[i]];
    }
}

function drawCard() {
    return deck.pop();
}

function startGame() {
    if (betAmount < 100) {
        alert("Taruhan minimal $100");
        return;
    }

    resetGame();
    gameStarted = true;
    initializeDeck();
    shuffleDeck();

    playerCards.push(drawCard(), drawCard());
    botCards.push(drawCard(), drawCard());

    playerTotal = calculateTotal(playerCards);
    botTotal = calculateTotal(botCards);

    renderCards();
    updateDisplay();

    document.getElementById('hit').disabled = false;
    document.getElementById('stand').disabled = false;
}

function hit() {
    if (!gameStarted) return;

    playerCards.push(drawCard());
    playerTotal = calculateTotal(playerCards);

    renderCards();
    updateDisplay();

    if (playerTotal > 21) {
        gameOver = true;
        endGame(false);
    }
}

function stand() {
    if (!gameStarted) return;

    backcardImg.style.display = 'none';
    gameStarted = false;

    while (botTotal < 17) {
        botCards.push(drawCard());
        botTotal = calculateTotal(botCards);
    }

    updateDisplay();

    if (botTotal > 21 || playerTotal > botTotal) {
        endGame(true);
    } else if (playerTotal < botTotal) {
        endGame(false);
    } else {
        endGame(null);
    }
}

function calculateTotal(cards) {
    let sum = cards.reduce((acc, card) => acc + card.value, 0);
    let aceCount = cards.filter(card => card.name === "A").length;

    while (sum > 21 && aceCount > 0) {
        sum -= 10;
        aceCount--;
    }

    return sum;
}

function renderCards() {
    playerCardsDiv.innerHTML = '';
    playerCards.forEach(card => {
        const cardImg = document.createElement('img');
        cardImg.src = `Assets/Images/cards/${card.name}-${card.suit}.png`;
        playerCardsDiv.appendChild(cardImg);
    });

    botCardDiv.innerHTML = '';
    botCards.forEach((card, index) => {
        const cardImg = document.createElement('img');
        if (index === 0 && gameStarted) {
            botCardDiv.appendChild(backcardImg);
        } else {
            cardImg.src = `Assets/Images/cards/${card.name}-${card.suit}.png`;
            botCardDiv.appendChild(cardImg);
        }
    });

    if (gameOver) {
        botCardDiv.innerHTML = '';
        botCards.forEach(card => {
            const cardImg = document.createElement('img');
            cardImg.src = `Assets/Images/cards/${card.name}-${card.suit}.png`;
            botCardDiv.appendChild(cardImg);
        });
    }
}

function resetGame() {
    playerCards = [];
    botCards = [];
    playerTotal = 0;
    botTotal = 0;
    gameStarted = false;
    gameOver = false;
    
    document.getElementById('hit').disabled = true;
    document.getElementById('stand').disabled = true;

    backcardImg.style.display = 'block';
    updateDisplay();
}

function endGame(playerWins) {
    gameOver = true;

    renderCards();  
    botTotalDisplay.innerText = botTotal;

    document.getElementById('hit').disabled = true;
    document.getElementById('stand').disabled = true;

    setTimeout(() => {
        if (playerWins === true) {
            alert("WIN!");
            playerMoney += betAmount * 2;
        } else if (playerWins === false) {
            alert("LOSE!");
        } else {
            alert("DRAW!");
            playerMoney += betAmount;
        }

        betAmount = 0;
        updateDisplay();

        if (playerMoney < 100) {
            displayGameOver();
        } else {
            setTimeout(clearCards, 2000);
        }
    }, 700); 
}


function clearCards() {
    playerCardsDiv.innerHTML = '';
    botCardDiv.innerHTML = '';
    resetGame();
}

function displayGameOver() {
    document.body.innerHTML = "<h1>GAME OVER!!!</h1><button onclick='location.reload()'>Restart Game</button>";
}


