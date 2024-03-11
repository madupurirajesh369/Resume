    document.getElementById('splitButton').addEventListener('click', function() {
    var number = parseInt(document.getElementById('numberInput').value);
    var splits = parseInt(document.getElementById('splitInput').value);
    var resultDiv = document.getElementById('result');
    resultDiv.innerHTML = '';

    if (isNaN(number) || isNaN(splits) || number <= 0 || splits <= 0) {
        resultDiv.innerHTML = 'Please enter valid numbers.';
        return;
    }

    var splitAmount = Math.floor(number / splits);
    var remainder = number % splits;

    for (var i = 0; i < splits; i++) {
        var splitValue = splitAmount + (i < remainder ? 1 : 0);
        var newDiv = document.createElement('div');
        newDiv.classList.add('split');
        newDiv.style.width = (splitValue * 10) + 'px';
        newDiv.textContent = splitValue;
        resultDiv.appendChild(newDiv);
    }
});
