// Function to add a new task
function addTask() {
  const taskInput = document.getElementById("task-input");
  const taskValue = taskInput.value.trim();

  if (taskValue) {
    const taskList = document.getElementById("task-list");

    const li = document.createElement("li");
    li.innerHTML = `
            <input type="text" value="${taskValue}" disabled>
            <div class="actions">
                <button class="edit" onclick="editTask(this)">✏️</button>
                <button class="delete" onclick="deleteTask(this)">❌</button>
            </div>
        `;

    taskList.appendChild(li);
    taskInput.value = ""; // Clear input field after adding
  } else {
    alert("Please enter a task.");
  }
}

// Function to delete a task
function deleteTask(button) {
  const li = button.parentElement.parentElement;
  li.remove();
}

// Function to edit a task
function editTask(button) {
  const li = button.parentElement.parentElement;
  const input = li.querySelector('input[type="text"]');

  if (input.disabled) {
    input.disabled = false;
    input.focus();
    button.innerHTML = "💾"; // Change to save icon
  } else {
    input.disabled = true;
    button.innerHTML = "✏️"; // Revert to edit icon
  }
}
