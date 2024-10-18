let display = document.getElementById("display");

function appendToDisplay(value) {
  // Cek apakah value yang ditekan adalah operator
  const operators = ["+", "-", "*", "/", "^", "%"];
  let lastChar = display.value.slice(-1);

  if (operators.includes(lastChar) && operators.includes(value)) {
    // Jika karakter terakhir adalah operator, ganti dengan operator baru
    display.value = display.value.slice(0, -1) + value;
  } else {
    // Tambahkan karakter ke display
    display.value += value;
  }
}

function clearDisplay() {
  display.value = "";
}

function calculate() {
  let expression = display.value;

  // Handling power (^) operator
  if (expression.includes("^")) {
    let parts = expression.split("^");
    display.value = Math.pow(parseFloat(parts[0]), parseFloat(parts[1]));
    return;
  }

  // Replacing modulus operator (%) with JavaScript modulo operator
  expression = expression.replace("%", "/100");

  try {
    display.value = eval(expression);
  } catch (error) {
    display.value = "Error";
  }
}
