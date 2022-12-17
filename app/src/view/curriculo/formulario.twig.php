{% extends 'partials/template.twig.php' %}

{% block title %} Job Application | Cadastro de Currículo {% endblock %}

{% block body %}
<form action="/formulario-salvar" method="post">
  <div class="row px-4 py-5 bg-light">
    <div class="col-6">
      <div class="mb-3">
        <label for="firstName" class="form-label">Nome</label>
        <input type="text" class="form-control" id="firstName" aria-describedby="firstNameHelp" name="nome">
        <p id="firstNameHelp" class="form-text">
            Informe apenas o seu nome.
        </p>
      </div>
      <button type="submit" class="btn btn-primary">Enviar Formulário</button>
    </div>
  </div>
</form>
{% endblock %}