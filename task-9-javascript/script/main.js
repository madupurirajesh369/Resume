document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('splitButton').addEventListener('click', function() {
        var number = parseInt(document.getElementById('numberInput').value);
        var splits = parseInt(document.getElementById('splitInput').value);
        var resultDiv = document.getElementById('result');
        resultDiv.innerHTML = '';

        if (isNaN(number) || isNaN(splits) || number <= 0 || splits <= 0) {
            resultDiv.innerHTML = 'Please enter valid numbers.';
            return;
        }

        if (number < splits) {
            resultDiv.innerHTML = 'The number must be greater than or equal to the split number.';
            return;
        }

        var splitAmount = Math.floor(number / splits);
        var remainder = number % splits;

        var colors = ['#FF5733', '#C70039', '#900C3F', '#581845', '#FF5733', '#C70039', '#900C3F', '#581845', '#FF5733', '#C70039'];

        for (var i = 0; i < splits; i++) {
            var splitValue = splitAmount + (i < remainder ? 1 : 0);
            var newDiv = document.createElement('div');
            newDiv.classList.add('split');
            var boxWidth = (splitValue / number) * 100; 
            newDiv.style.flex = '0 0 ' + boxWidth + '%'; 
            newDiv.textContent = splitValue;
            newDiv.style.backgroundColor = colors[i % colors.length]; // Assign color from the array
            resultDiv.appendChild(newDiv);
        }
    });
});
