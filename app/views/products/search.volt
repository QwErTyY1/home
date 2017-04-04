{% for product in page.items%}

{% if loop.first %}
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Product type</th>
        <th>Product title</th>
        <th>Coins</th>
        <th>Active</th>
    </tr>
    </thead>
    <tbody>
    {% endif %}
    <tr>
        <td>
            {{ product.id }}
        </td>
        <td>
            {{ product.getProductTypes().name}}
        </td>
        <td>
            {{ product.name}}
        </td>
        <td>
            {{ "%2f"|format(product.price) }}
        </td>
        <td>
            {{ product.getActive() }}
        </td>

        <td>
            {{ link_to("products/edit/" ~ product.id,"Edit Product") }}
        </td>

        <td width="7%">
            {{ link_to("products/delete/" ~ product.id, "Delete") }}
        </td>

    </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="7">
                <div>
                        {{ link_to("products/search", "First") }}
                        {{ link_to("products/search?page=" ~ page.before,"Before") }}
                        {{ link_to("products/search?page=" ~ page.next, "Next")    }}
                        {{ link_to("products/search?page=" ~ page.last, "Last")    }}
                    <span class="help-inline">
                        {{ page.curret }}  {{ page.total }}
                    </span>
                </div>

                </tr>
    </tbody>
    {% endif %}
{% else %}

{% endfor %}