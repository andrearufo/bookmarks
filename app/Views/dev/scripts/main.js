var app = new Vue({

    el: '#app',

    data: {
        ux: {
            loading: true,
            fetch: false,
            error: false,
            success: false
        },
        url: 'https://',
        fetch: null,
        bookmarks: []
    },

    computed: {
        list: function(){
            return _.orderBy(this.bookmarks, 'created_at', 'desc');
        }
    },

    methods: {
        getLinks: function(){
            this.ux.loading = true;

            this.$http.get('api/list').then(function(response){
                this.bookmarks = response.body.links;
                this.ux.loading = false;
            }, function(response){
                this.ux.error = true;
                this.ux.loading = false;
            });
        },

        fetchLink: function(){
            this.ux.success = false;
            this.ux.loading = true;

            this.$http.post('api/fetch', { url: this.url }, { emulateJSON: true }).then(function(response){
                this.fetch = response.body.link;
                this.ux.fetch = true;
                this.ux.loading = false;
            }, function(response){
                this.ux.error = true;
                this.ux.loading = false;
            });
        },

        saveLink: function(){
            this.ux.fetch = false;
            this.ux.loading = true;

            this.$http.post('api/save', { url: this.url }, { emulateJSON: true }).then(function(response){
                this.fetch = null;
                this.ux.success = true;
                this.ux.loading = false;
                this.getLinks();
            }, function(response){
                this.ux.error = true;
                this.ux.loading = false;
            });
        },

        deleteLink: function(id){
            this.ux.loading = true;

            this.$http.post('api/delete', { id: id }, { emulateJSON: true }).then(function(response){
                this.ux.success = true;
                this.ux.loading = false;
                this.getLinks();
            }, function(response){
                this.ux.error = true;
                this.ux.loading = false;
            });
        }
    },

    mounted: function(){
        this.getLinks();
    }
});
