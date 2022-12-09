export default {

   // Get table data
    getResults(page = 1) {
        this.dataLoading = true;
        axios.get(this.currentUrl+'/index?page=' + page +
                '&paginate=' + this.paginate +
                '&search=' + this.search +
                '&sort_direction=' + this.sort_direction +
                '&sort_field=' + this.sort_field +
                '&search_field=' + this.search_field +
                '&start_date=' + this.start_date +
                '&end_date=' + this.end_date
            
            )
            .then(response => {
                // console.log(response);
                //console.log(response.data.from, response.data.to);
                this.allData = response.data;
                this.totalValue = response.data.total;
                // this.dataShowFrom = response.data.from;
                // this.dataShowTo = response.data.to;
            
                // Loading Animation
                this.dataLoading = false;

            });
    },

  
    // DataTable Shorting by field name
    change_sort(field) {
        this.$Progress.start();
        if (this.sort_field == field) {
            this.sort_direction = this.sort_direction == "asc" ? "desc" : "asc";
        } else {
            this.sort_field = field;
        }
        this.getResults();
        this.$Progress.finish();
    },

    
}