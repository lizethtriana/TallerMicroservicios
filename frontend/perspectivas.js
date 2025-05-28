// URL base del backend (API REST)
const apiUrl = 'http://localhost:8000/api/retro_items';

// 👉 Función para cargar la lista de retrospectivas
function cargarRetros() {
  fetch(apiUrl) // Pedimos los datos al servidor
    .then(respuesta => respuesta.json()) // Convertimos la respuesta a JSON
    .then(datos => {
      const lista = document.getElementById('retro-items'); // Seleccionamos el <ul>
      lista.innerHTML = ''; // Limpiamos la lista antes de volver a cargarla

      // Recorremos cada item recibido desde el servidor
      datos.data.forEach(item => {
        // Creamos un <li> con los datos
        const li = document.createElement('li');
        li.innerHTML = `
          <strong>${item.categoria.toUpperCase()}</strong>: ${item.descripcion}<br>
          <em>Cumplida:</em> ${item.cumplida ? '✅' : '❌'} |
          <em>Revisión:</em> ${item.fecha_revision}<br>
          <button onclick="eliminarRetro(${item.id})">🗑 Eliminar</button>
          <button onclick='editarRetro(${JSON.stringify(item)})'>✏ Editar</button>
        `;
        lista.appendChild(li); // Agregamos el <li> al <ul>
      });
    });
}

// 👉 Función para guardar o actualizar una retrospectiva
document.getElementById('form-retro').addEventListener('submit', function (evento) {
  evento.preventDefault(); // Evitamos que la página se recargue

  const form = new FormData(this); // Capturamos los datos del formulario
  const retroId = this.dataset.editingId; // Si hay un id, es una edición

  // Creamos un objeto con los datos
  const retroData = {
    sprint_id: form.get('sprint_id'),
    categoria: form.get('categoria'),
    descripcion: form.get('descripcion'),
    cumplida: form.get('cumplida') === 'on', // Checkbox
    fecha_revision: form.get('fecha_revision')
  };

  // Si hay id, es PUT (editar); si no, es POST (crear)
  const url = retroId ? `${apiUrl}/${retroId}` : apiUrl;
  const metodo = retroId ? 'PUT' : 'POST';

  // Enviamos los datos al servidor
  fetch(url, {
    method: metodo,
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(retroData)
  })
    .then(respuesta => {
      if (respuesta.ok) {
        alert(retroId ? 'Retro actualizada' : 'Retro guardada');
        this.reset(); // Limpiamos el formulario
        delete this.dataset.editingId; // Quitamos el modo edición
        cargarRetros(); // Recargamos la lista
      } else {
        return respuesta.json().then(error => {
          alert('Error: ' + (error.message || 'No se pudo guardar'));
        });
      }
    });
});

// 👉 Función para eliminar una retrospectiva
function eliminarRetro(id) {
  if (!confirm('¿Seguro que deseas eliminar esta retrospectiva?')) return;

  fetch(`${apiUrl}/${id}`, {
    method: 'DELETE'
  })
    .then(respuesta => {
      if (respuesta.ok) {
        alert('Retro eliminada');
        cargarRetros(); // Recargamos la lista
      } else {
        return respuesta.json().then(error => {
          alert('Error: ' + (error.message || 'No se pudo eliminar'));
        });
      }
    });
}

// 👉 Función para llenar el formulario con los datos a editar
function editarRetro(item) {
  const form = document.getElementById('form-retro');
  form.sprint_id.value = item.sprint_id;
  form.categoria.value = item.categoria;
  form.descripcion.value = item.descripcion;
  form.cumplida.checked = item.cumplida;
  form.fecha_revision.value = item.fecha_revision;

  form.dataset.editingId = item.id; // Guardamos el ID en el formulario para editar

  window.scrollTo({ top: 0, behavior: 'smooth' }); // Subimos al formulario
}

// 👉 Al iniciar, cargamos la lista
cargarRetros();