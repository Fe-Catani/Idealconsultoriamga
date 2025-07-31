function toggleSettingsMenu() {
    const menu = document.getElementById('settingsMenu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}
document.querySelectorAll('.btn-status').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const userId = this.dataset.userId;
        const action = this.dataset.action;
        fetch(`alterar_status.php?alterar_status=${action}&id=${userId}`, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status do usuário alterado com sucesso.');
                location.reload();
            } else {
                alert('Erro ao alterar status do usuário: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao alterar status do usuário.');
        });
    });
});