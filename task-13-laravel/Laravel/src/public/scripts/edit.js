function edit(id, title, status) {
    document.getElementById('edit-title').value = title;
    document.getElementById('edit-status').value = status;
    var formAction = document.getElementById('editForm').action;
    formAction = formAction.replace(':id', id);
    document.getElementById('editForm').action = formAction;
}