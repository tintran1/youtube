<script>
    function Waiter(milliseconds) {
        let yes = true;
        this.wait = func => {
            if (yes) {
                func();
                yes = false;
                setTimeout(() => {
                    yes = true;
                }, milliseconds);                                    
            }
            return this;
        }
    }
    var SubsribeWaiter = new Waiter(2500);
</script>