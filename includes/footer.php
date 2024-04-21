<?php
if (isset($_SESSION['guul']) && isset($_SESSION['message'])) {

?>

    <script>
        swal({
            title: "<?php echo $_SESSION['message']; ?>",
            icon: "<?php echo $_SESSION['guul']; ?>",
            button: "Ok!",
        });
    </script>

<?php
    unset($_SESSION['message']);
    unset($_SESSION['guul']);
}
?>
</body>

</html>