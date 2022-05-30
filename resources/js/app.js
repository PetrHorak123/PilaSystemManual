require('./bootstrap');

import Editor from '@toast-ui/editor'
import '@toast-ui/editor/dist/toastui-editor.css';

const editor = new Editor({
  el: document.querySelector('#editor'),
  height: '400px',
  initialEditType: 'markdown',
})

if (document.querySelector('#createPostForm')) {
  document.querySelector('#createPostForm').addEventListener('submit', e => {
      e.preventDefault();
      document.querySelector('#content').value = editor.getMarkdown();
      e.target.submit();
  });
}

if (document.querySelector('#editPostForm')) {
  editor.setMarkdown(document.querySelector('#oldContent').value);

  document.querySelector('#editPostForm').addEventListener('submit', e => {
      e.preventDefault();
      document.querySelector('#content').value = editor.getMarkdown();
      e.target.submit();
  });
}