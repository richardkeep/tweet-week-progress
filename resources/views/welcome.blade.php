
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Tweets Monitor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.css" media="screen">
    <link rel="stylesheet" href="https://bootswatch.com/_assets/css/custom.min.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        body {
            padding-top: 65px;
        }

       .table a:not(.btn) {
            text-decoration: none;
        }
    </style>

  </head>

  <body>

    <div  id="tweet">

    <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" style="">
          <div class="container">
            <a href="../" class="navbar-brand">Tweets Monitor</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Premier League <span class="caret"></span></a>
                  <div class="dropdown-menu" aria-labelledby="themes">
                    <a class="dropdown-item" @click.prevent="changeHashtag('HappyNewMonth')">#HappyNewMonth</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" @click.prevent="changeHashtag('#FPL')">#FPL</a>
                    <a class="dropdown-item" href="#"> <span @click.prevent="changeHashtag('Arsenal')">#Arsenal</span> </a>
                    <a class="dropdown-item" href="#" @click.prevent="changeHashtag('MUFC')">#MUFC</a>
                    <a class="dropdown-item" href="#" @click.prevent="changeHashtag('MCFC')">#MCFC</a>
                    <a class="dropdown-item" href="#" @click.prevent="changeHashtag('LFC')">#LFC</a>
                    <a class="dropdown-item" href="#" @click.prevent="changeHashtag('EPL')">#EPL</a>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Programming <span class="caret"></span></a>
                  <div class="dropdown-menu" aria-labelledby="themes">
                    <a class="dropdown-item" @click.prevent="changeHashtag('Laravel')">#Laravel</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" @click.prevent="changeHashtag('PHP')">#PHP</a>
                    <a class="dropdown-item" href="#"> <span @click.prevent="changeHashtag('Vuejs')">#Vuejs</span> </a>
                    <a class="dropdown-item" href="#" @click.prevent="changeHashtag('JavaScript')">#JavaScript</a>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Kenyan Trends <span class="caret"></span></a>
                  <div class="dropdown-menu" aria-labelledby="themes">
                    <a class="dropdown-item" href="#" @click.prevent="changeHashtag('IkoKaziKe')">#IkoKaziKe</a>
                    <a class="dropdown-item" href="#"> <span @click.prevent="changeHashtag('Kenya')">#Kenya</span> </a>
                  </div>
                </li>
              </ul>

            </div>
          </div>
        </div>

      <div class="container">
        <div>
           <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="display:  flex;justify-content:  space-between;">
              <a class="navbar-brand" href="#">@{{ hashtag }}</a>
              <a v-show="!loading" class="navbar-brand" href="#"> @{{ total }} Tweets</a>
            </nav>

        </div>
        <table class="table table-hover table-bordered table-stripped">
          <tbody>
            <paginate name="tweets" :list="tweets" :per="10" class="paginate-list">
            <tr v-if="loading">
                <td colspan="2">
                    Loading...
                </td>
            </tr>
            <tr v-else class="table-green" v-for="t in paginated('tweets')" style="border-bottom: 2px solid lightslategrey;">

              <td width="5%" style="text-align:  center;">
                <img style="border-radius:  50%;" :src="t.profile_image_url">
            </td>
              <td>
                <div style="margin-bottom: 10px;"><a style="color: lightblue;font-weight: 600;" target="_blank" :href="profile_link(t)">@@{{ t.screen_name }}</a> </div>
                <div style="margin-bottom: 5px;">
                    <a target="_blank" :href="tweet_link(t)">@{{ t.text }}</a>
                </div>
                <div>
                    <div style="color: darkgray;">@{{ time_ago(t) }}</div>
                </div>

            </td>
            </tr>
            <tr v-show="!loading && tweets.length == 0">
                <td colspan="2">No new tweets found for <b>#@{{ hashtag }}</b>.</td>
            </tr>
          </paginate>
          </tbody>
        </table>

        <div v-show="!loading && tweets.length > 0">
            <paginate-links
             for="tweets"
             :limit="5"
             :show-step-links="true"
             class="pagination"
             :classes="{
                 'ul > li': 'page-item',
                 'ul > li > a': 'page-link'
               }"
             ></paginate-links>

        </div>
      </div>
     </div>
  <script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
     <script src="https://bootswatch.com/_vendor/popper.js/dist/umd/popper.min.js"></script>
     <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.min.js"></script>
     <script src="https://bootswatch.com/_assets/js/custom.js"></script>

      <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

     <script src="js/vue.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.10/lodash.js"></script>
     <script src="js/vue-paginate.js"></script>
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

     <script>

     window.thousand = function(num, fix) {
         var p = num.toFixed(fix).split(".");
         return p[0].split("").reduceRight(function(acc, num, i, orig) {
             if ("-" === num && 0 === i) {
                 return num + acc;
             }
             var pos = orig.length - i - 1
             return  num + (pos && !(pos % 3) ? "," : "") + acc;
         }, "") + (p[1] ? "." + p[1] : "");
     }

     toastr.options = {
         "closeButton": true,
         "debug": false,
         "newestOnTop": true,
         "progressBar": true,
         "positionClass": "toast-bottom-right",
         "preventDuplicates": false,
         "onclick": null,
         "showDuration": "300",
         "hideDuration": "1000",
         "timeOut": "5000",
         "extendedTimeOut": "1000",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "fadeIn",
         "hideMethod": "fadeOut"
     }

        new Vue({
          el: '#tweet',
          data: {
            loading: true,
            microseconds: 2000,
            hashtag: '#FPL',
            tweets: [],
            paginate: ['tweets']
          },
          computed: {
            total() {
                return thousand(this.tweets.length)
            }
          },
          created() {
            this.fetchTweetsAtInterval()
          },
          methods: {
            time_ago(t)
            {
                return moment(t.created_at).fromNow();
            },
            reload() {
                clearInterval(this.fetchTweetsAtInterval);

                myTimer = this.fetchTweetsAtInterval();
            },
            fetchTweetsAtInterval()
            {

                setInterval(function(){
                    this.fetchTweets()
                }.bind(this), this.microseconds);
            },
            changeHashtag(hashtag)
            {
                this.loading = true

                toastr.info('#'+hashtag, 'Hashtag changed to:');

                this.hashtag = hashtag

                this.reload()
            },
            tweet_link(t)
            {
                return "https://twitter.com/" + t.screen_name + "/status/" + t.id_str
            },
            profile_link(t)
            {
                return "https://twitter.com/" + t.screen_name
            },
            fetchTweets() {
                var tws = _.filter(this.tweets, ['hashtag', '#' + this.hashtag])

                var last = _.maxBy(tws, 'id');

                var id = last ? last.id : 'null'

                axios.post('fetch-tweets', {hashtag: this.hashtag, id: id})
                .then(res => {
                    this.loading = false
                    if(id == 'null') {
                        this.tweets = res.data.tweets
                    } else {
                        Array.prototype.push.apply(this.tweets, res.data.tweets);
                    }

                    this.tweets = _.orderBy(this.tweets, ['id'], ['desc']);
                })
                .catch(e => console.log(e))
            }
          }
        })

     </script>
   </body>

</html>
