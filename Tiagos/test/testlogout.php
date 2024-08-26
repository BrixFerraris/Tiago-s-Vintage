<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
        /* Basic styling for the dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            min-width: 160px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        /* Show the dropdown when the person icon is clicked */
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>

    <div class="dropdown">
        <a>
            <span class="material-icons-outlined">person</span>
        </a>
        <div class="dropdown-content">
            <a href="#">Settings</a>
            <a href="#">Log Out</a>
        </div>
    </div>

    <script>
        // JavaScript to toggle dropdown on click
        document.querySelector('.dropdown').addEventListener('click', function(event) {
            event.stopPropagation();
            var dropdownContent = this.querySelector('.dropdown-content');
            dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', function(event) {
            var dropdowns = document.querySelectorAll('.dropdown-content');
            dropdowns.forEach(function(dropdown) {
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            });
        });
    </script>

</body>
</html>
