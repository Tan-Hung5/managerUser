class AuthCodeInput {
    constructor(id) {
      this.element = document.getElementById(id);
      this.maxLength = parseInt(this.element.getAttribute("maxlength"));
      this.id = parseInt(id.substr(-1));
      this.setupEvents();
    }

    setupEvents() {
      this.element.addEventListener("input", () => this.moveToNext());
      this.element.addEventListener("keydown", (event) => this.moveOnBackspace(event));
    }

    moveToNext() {
      if (this.element.value.length === this.maxLength && this.id < 6) {
        document.getElementById("digit" + (this.id + 1)).focus();
      }
    }

    moveOnBackspace(event) {
      if (event.key === "Backspace" && this.id > 1 && this.element.value.length === 0) {
        document.getElementById("digit" + (this.id - 1)).focus();
      }
    }
  }




function openModal(userId) {
    var modal = document.getElementById('deleteModal');
    modal.style.display = 'block';
    modal.dataset.userId = userId;
}

function closeModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

function deleteUser() {
    var userId = document.getElementById('deleteModal').dataset.userId;
    // Add PHP code here to delete user with the specified ID
    alert('User ' + userId + ' deleted!');
    closeModal();
}

// Attach event listeners to delete buttons
var deleteButtons = document.querySelectorAll('.delete-btn');
deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var userId = this.dataset.userId;
        openModal(userId);
    });
});


  

  
  
