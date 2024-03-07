// Add your custom JS here.
async function postData(url, formData) {
  const response = await fetch( url, {
    method: 'POST',
    body: formData
  });
  return await response.json();
};


function submitFrom() {
  const forms = document.querySelectorAll('form.ns_form');
  console.log(forms)

  if (forms.length === 0) return false;

  forms.forEach(function(form) {
    form.addEventListener('submit', (event) => {
      event.preventDefault();
      // можно например тут сделать форму не доступной
      const formData = new FormData(form);
    
      formData.append('nonce_code', ns_ajax.nonce);
  
      postData(ns_ajax.url, formData)
        .then((response) => {
          if (response.data.html !== true) {
            console.log(response);
            form.querySelector('.form-response').innerHTML = response.data.html;
          }
        })
        .catch((error) => {
          console.error(error);
        })
        .finally(() => {
          // можно например форму сделать снова доступной
        });
    });
  })
}


submitFrom();
console.log('here');


