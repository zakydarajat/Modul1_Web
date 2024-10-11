let display = document.getElementById("display");

function appendToDisplay(value) {
  display.value += value;
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
