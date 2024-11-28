<script>
function excluirAnimal(id) {
    if (confirm('Tem certeza que deseja excluir este animal?')) {
        window.location.href = 'excluirAnimal.php?id=' + id;
    }
}
</script>
