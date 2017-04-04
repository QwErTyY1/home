{#{{ content() }}#}

{{ form("products/create") }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("products", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ submit_button("Save", "class": "btn btn-success") }}
    </li>
</ul>

<fieldset>

    {% for element in form %}


            <div class="form-group">
                {{ element.label() }}
                {{ element.render(['class': 'form-control']) }}
            </div>

    {% endfor %}

</fieldset>

</form>