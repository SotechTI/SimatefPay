grecaptcha.ready(function() {
    grecaptcha.execute('6Ld7B30UAAAAAMBZxRYYNNRqBUC179Uz-2WHwlpv', {action: 'login'})
    .then(function(token) {
        document.getElementById('g-recaptcha-response').value=token;
    });
});