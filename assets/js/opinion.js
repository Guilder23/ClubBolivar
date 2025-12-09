// Comentarios dinámicos para la sección de opinión
document.addEventListener('DOMContentLoaded', function() {
	const form = document.getElementById('commentForm');
	const commentsList = document.getElementById('commentsList');
	let comments = JSON.parse(localStorage.getItem('opinionComments') || '[]');

	function renderComments() {
		commentsList.innerHTML = '';
		comments.forEach((comment, idx) => {
			const li = document.createElement('li');
			li.className = 'comment-item';
			li.innerHTML = `<strong>${comment.name}</strong>: ${comment.text}`;
			// Respuestas
			if (comment.replies && comment.replies.length > 0) {
				const repliesUl = document.createElement('ul');
				repliesUl.className = 'replies-list';
				comment.replies.forEach(reply => {
					const replyLi = document.createElement('li');
					replyLi.className = 'reply-item';
					replyLi.innerHTML = `<strong>${reply.name}</strong>: ${reply.text}`;
					repliesUl.appendChild(replyLi);
				});
				li.appendChild(repliesUl);
			}
			// Ícono para mostrar el formulario de respuesta
			const replyIcon = document.createElement('button');
			replyIcon.className = 'reply-icon';
			replyIcon.innerHTML = '↩️';
			li.appendChild(replyIcon);
			let replyFormVisible = false;
			let replyForm;
			replyIcon.addEventListener('click', function() {
				if (!replyFormVisible) {
					replyForm = document.createElement('form');
					replyForm.className = 'reply-form';
					replyForm.innerHTML = `
						<input type="text" name="replyName" placeholder="Tu nombre" required>
						<input type="text" name="replyText" placeholder="Responder..." required>
						<button type="submit">Responder</button>
					`;
					replyForm.addEventListener('submit', function(e) {
						e.preventDefault();
						const replyName = replyForm.replyName.value.trim();
						const replyText = replyForm.replyText.value.trim();
						if (replyName && replyText) {
							if (!comments[idx].replies) comments[idx].replies = [];
							comments[idx].replies.push({ name: replyName, text: replyText });
							localStorage.setItem('opinionComments', JSON.stringify(comments));
							renderComments();
						}
						replyForm.reset();
					});
					li.appendChild(replyForm);
					replyFormVisible = true;
				}
			});
			commentsList.appendChild(li);
		});
	}

	form.addEventListener('submit', function(e) {
		e.preventDefault();
		const name = document.getElementById('userName').value.trim();
		const text = document.getElementById('userComment').value.trim();
		if (name && text) {
			comments.unshift({ name, text, replies: [] }); // Agrega arriba
			localStorage.setItem('opinionComments', JSON.stringify(comments));
			renderComments();
			form.reset();
		}
	});

	renderComments();
});
// JS para opinion.html
