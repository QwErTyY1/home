{% for user in page.items%}

    {% if loop.first %}
        <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>User name</th>
            <th>Name</th>
            <th>Created at</th>
            <th>Active</th>
        </tr>
        </thead>
        <tbody>
    {% endif %}


    <tr>
        <td>
            {{ user.user_id }}
        </td>
        <td>
            {{ user.user_name}}
        </td>
        <td>
            {{ product.name}}
        </td>
        <td>
            {{ user.users_active }}
        </td>
        <td>
            {{ users.created_at }}
        </td>


    </tr>
    {e}
    {% if loop.last %}
    </tbody>
    <tbody>
    <tr>
        <td colspan="7">
            <div>
                {{ link_to("contact/search", "First") }}
                {{ link_to("contact/search?page=" ~ page.before,"Before") }}
                {{ link_to("contact/search?page=" ~ page.next, "Next")    }}
                {{ link_to("contact/search?page=" ~ page.last, "Last")    }}
                <span class="help-inline">
                        {{ page.curret }}  {{ page.total }}
                    </span>
            </div>

    </tr>
    </tbody>
    {% endif %}
{% else %}

{% endfor %}