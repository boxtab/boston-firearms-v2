<div class="schedule">
    <ul>
        <% _.each(day.events, function(event) { %>
            <li><div><%= event.title %></div> <a href="<%= event.url %>">Attend Class</a></li>
        <% }); %>
    </ul>
</div>
