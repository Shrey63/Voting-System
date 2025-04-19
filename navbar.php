<style>
    /* Global Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box; /* Ensures padding and margin don't affect the element's width */
    }

    body {
        font-family: Arial, sans-serif; /* You can use your preferred font */
        background-color: #f4f4f4; /* Light background to make the navbar stand out */
    }

    /* Navbar styles */
    .navbar {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #003366; /* Dark blue background */
        padding: 15px 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
        width: 100%;  /* Ensure navbar always spans full width */
        margin: 0 auto;  /* Reset any potential margin */
    }

    .navbar a {
        color: white;
        text-decoration: none;
        padding: 12px 25px;
        font-size: 18px;
        font-weight: bold;
        transition: background-color 0.3s ease;
        border-radius: 8px;
        margin: 0 15px;  /* Add more space between links */
        display: block;
    }

    .navbar a:hover {
        background-color: #0041cc;  /* Lighter blue on hover */
    }

    .navbar a.active {
        background-color: #0033aa;  /* Highlight active page */
    }

    /* Optional: Navbar responsiveness */
    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;  /* Stack navbar items on small screens */
        }

        .navbar a {
            margin: 10px 0;  /* Reduce margin when stacking */
        }
    }
</style>

<div class="navbar">
    <a href="vote.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'vote.php' ? 'active' : ''; ?>">Vote</a>
    <a href="comments.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'comments.php' ? 'active' : ''; ?>">Comments</a>
    <a href="results.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'results.php' ? 'active' : ''; ?>">Results</a>
</div>
