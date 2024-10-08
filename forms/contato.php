<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar os dados do formulário
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Verificar se os campos obrigatórios foram preenchidos
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Resposta em caso de erro
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Definir destinatário do e-mail (seu e-mail)
    $recipient = "seu-email@dominio.com";  // Insira seu e-mail aqui

    // Construir o conteúdo do e-mail
    $email_subject = "Novo contato de: $name - $subject";
    $email_content = "Nome: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensagem:\n$message\n";

    // Cabeçalhos do e-mail
    $email_headers = "From: $name <$email>";

    // Enviar o e-mail
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Sucesso
        echo "Sua mensagem foi enviada com sucesso!";
    } else {
        // Erro
        echo "Ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente.";
    }
}
?>
