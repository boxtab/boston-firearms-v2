<div class="schedule">
    <ul>
        <% _.each(day.events, function(event) { %>
            <li><div id="<%= event.title %>" onclick='setAppointment("<%= event.id %>", "<%= event.reschedule_date_time %>")'><%= event.title %></div></li>
        <% }); %>
    </ul>
</div>
