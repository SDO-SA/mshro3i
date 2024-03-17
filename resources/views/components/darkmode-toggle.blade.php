<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Check if dark mode preference is stored in localStorage
        var darkMode = localStorage.getItem('darkMode');
        if (darkMode === null) {
            // If not found, check the session value
            darkMode = {{ session('darkMode') ? 'true' : 'false' }};
        } else {
            // If found, convert the stored value to boolean
            darkMode = JSON.parse(darkMode);
        }

        // Set initial dark mode state
        if (darkMode) {
            $('body').addClass('dark');
            $('.theme-controller').prop('checked', true); // Check the checkbox
        } else {
            $('body').removeClass('dark');
            $('.theme-controller').prop('checked', false); // Uncheck the checkbox
        }

        // Toggle dark mode when the checkbox is clicked
        $('.theme-controller').click(function() {
            darkMode = !darkMode;
            if (darkMode) {
                $('body').addClass('dark');
            } else {
                $('body').removeClass('dark');
            }

            // Save the preference in localStorage
            localStorage.setItem('darkMode', JSON.stringify(darkMode));

            // Send AJAX request to update session
            $.get('{{ route("toggle-dark-mode") }}');
        });
    });
</script>

<label class="flex cursor-pointer gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5"/>
            <path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4"/>
        </svg>
        <input type="checkbox" value="synthwave" class="toggle theme-controller"/>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
        </svg>
    </label>