function edit(id, name, email) {
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-email').value = email;
    var formAction = document.getElementById('editForm').action;
    formAction = formAction.replace(':id', id);
    document.getElementById('editForm').action = formAction;
}