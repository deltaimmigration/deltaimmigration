.then(data => {
  thisForm.querySelector('.loading').classList.remove('d-block');
  
  // Tenta analisar a resposta como JSON
  try {
    let jsonResponse = JSON.parse(data);
    
    // Verifica se a resposta tem a propriedade "ok" e se ela é verdadeira
    if (jsonResponse.ok) {
      thisForm.querySelector('.sent-message').classList.add('d-block');
      thisForm.reset();
      
      // Redireciona para a página de agradecimento, se necessário
      if (jsonResponse.next) {
        window.location.href = jsonResponse.next;
      }
    } else {
      throw new Error('Form submission failed');
    }
  } catch (e) {
    // Caso a resposta não seja JSON válido, ou se houver erro
    throw new Error(data ? data : 'Form submission failed and no error message returned from: ' + action);
  }
})

