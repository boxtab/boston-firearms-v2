<div id="mini-clndr"></div>


<script id="template-calendar" type="text/template">
    <div class="controls">
        <div class="clndr-previous-button">&lsaquo;</div><div class="month"><%= month %></div><div class="clndr-next-button">&rsaquo;</div>
    </div>

    <div class="days-container">
        <div class="days">
            <div class="headers">
                <% _.each(daysOfTheWeek, function(day) { %><div class="day-header"><%= day %></div><% }); %>
            </div>
            <% _.each(days, function(day) { %><div class="<%= day.classes %>" id="<%= day.id %>"><%= day.day %></div><% }); %>
        </div>
    </div>
</script>


<div class="button-row">
    <button id="target-button" class="button">Test</button>
</div>
