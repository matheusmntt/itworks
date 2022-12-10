{% extends 'partials/template.twig.php' %}

{% block title %} Novo Registro {% endblock %}

{% block body %}
<h1>Novo Registro</h1>
<form action="{{BASE}}conta-salvar" method="post">

    <div class="mt-3">
        <label for="txtValor" class="form-label">Valor
            <input type="text" name="txtValor" id="txtValor" class="form-control" placeholder="Valor" required />
        </label>
    </div>

    <div class="mt-3">
        <label for="selMovimentacao" class="form-label">Movimentação</label>
        <select name="selMovimentacao" id="selMovimentacao" class="form-control">
            <option value="">Selecione</option>
            <option value="credito">CRÉDITO</option>
            <option value="debito">DÉBITO</option>
        </select>
    </div>

    <div class="mt-3 text-right">
        <button type="submit" class="btn btn-success">Salvar</button>
    </div>

</form>

{% endblock %}