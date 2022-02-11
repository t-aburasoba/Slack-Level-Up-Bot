<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ asset('images/ogp.png') }}">
        <meta property="og:title" content="Slack Levelup Bot">
        <meta property="og:description" content="Slack の投稿でユーザーのレベルが上がります。">
        <meta property="og:locale" content="ja">
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

        <title>Slack Levelup bot</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <script src="{{ mix('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">Slack Levelup Bot</span>
                <span class="d-none d-lg-block">
                    <img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                         src="{{ asset('images/logo.png') }}"
                         alt="logo"
                         style="width: 150px; height: 150px; object-fit: cover"
                    />
                </span>
            </a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#how-to-use">How to use</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#who-is-me">Who is me</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#thanks">Thanks</a></li>
                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- About-->
            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    @if (session('message'))
                        <h3 class="text-primary">{{ session('message') }}</h3>
                    @endif
                    <h1 class="mb-0">
                        Slack
                        <span class="text-primary">Level up bot</span>
                    </h1>
                    <div class="subheading mb-5">
                        created by
                        <a href="https://twitter.com/aburasobablog" target="_blank">T.tsubasa</a>
                    </div>
                    <p class="lead mb-5">
                        <span class="text-primary">現在 beta 版です。データのリセット等が行われることがありますので予めご了承ください。</span>
                        <br>
                        Slack を盛り上げるためにゲーミフィケーションを導入しましょう。
                        <br>
                        Slack Levelup Bot を導入すると各ユーザーの投稿やリアクションに応じてレベルが上がります。
                    </p>
                    <div class="mb-5">
                        <a href="https://slack.com/oauth/v2/authorize?client_id=771687717684.2967129835249&scope=chat:write,chat:write.customize,chat:write.public,commands,incoming-webhook&user_scope=channels:history,reactions:read"><img alt="Add to Slack" height="40" width="139" src="https://platform.slack-edge.com/img/add_to_slack.png" srcSet="https://platform.slack-edge.com/img/add_to_slack.png 1x, https://platform.slack-edge.com/img/add_to_slack@2x.png 2x" /></a>
                    </div>
                    <div class="social-icons">
                        <a class="social-icon" target="_blank" href="https://github.com/t-aburasoba/Slack-Level-Up-Bot">
                            <i class="fab fa-github"></i>
                        </a>
                        <a class="social-icon" target="_blank" href="https://twitter.com/aburasobablog">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Experience-->
            <section class="resume-section" id="how-to-use">
                <div class="resume-section-content">
                    <h2 class="mb-5">How to use</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-3">Install to workspace</h3>
                            <div>
                                <a href="https://slack.com/oauth/v2/authorize?client_id=771687717684.2967129835249&scope=chat:write,chat:write.customize,chat:write.public,commands,incoming-webhook&user_scope=channels:history,reactions:read"><img alt="Add to Slack" height="40" width="139" src="https://platform.slack-edge.com/img/add_to_slack.png" srcSet="https://platform.slack-edge.com/img/add_to_slack.png 1x, https://platform.slack-edge.com/img/add_to_slack@2x.png 2x" /></a>
                            </div>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">STEP 1</span></div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-3">Level Up</h3>
                            <p>ワークスペースにインストールできたら、積極的に発言・反応を行いましょう。<br>積極的な活動を行うことで、あなたのレベルがどんどん上がっていきます。</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">STEP 2</span></div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-3">Check Level</h3>
                            <p>/level コマンドを使用して、あなたのレベル・次のレベルアップに必要な経験値を確認しましょう。</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">STEP 3</span></div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-3">Coming soon ....</h3>
                            <p>Slack での活動が活発になるような仕組みをどんどん開発していきます。ご要望等ございましたら <a href="https://twitter.com/aburasobablog" target="_blank">Twitter</a> からお問い合わせください。</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">STEP ?</span></div>
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Skills-->
            <section class="resume-section" id="skills">
                <div class="resume-section-content">
                    <h2 class="mb-5">Skills</h2>
                    <div class="subheading mb-3">Programming Languages & Tools</div>
                    <ul class="list-inline dev-icons">
                        <li class="list-inline-item"><i class="fab fa-slack"></i></li>
                        <li class="list-inline-item"><i class="fab fa-laravel"></i></li>
                        <li class="list-inline-item"><i class="fab fa-html5"></i></li>
                        <li class="list-inline-item"><i class="fab fa-css3-alt"></i></li>
                        <li class="list-inline-item"><i class="fab fa-sass"></i></li>
                        <li class="list-inline-item"><i class="fab fa-npm"></i></li>
                    </ul>
                    <div class="subheading mb-3">Slack API</div>
                    <ul class="fa-ul mb-0">
                        <li>
                            <span class="fa-li"><i class="fas fa-check"></i></span>
                            Slack App
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-check"></i></span>
                            Incoming web hook
                        </li>
                    </ul>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Education-->
            <section class="resume-section" id="who-is-me">
                <div class="resume-section-content">
                    <h2 class="mb-5">Who is me</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Software Developer</h3>
                            <div class="subheading mb-3">T.tsubasa</div>
                            <div class="mb-3">Laravel engineer.</div>
                            <div class="social-icons">
                                <a class="social-icon" target="_blank" href="https://github.com/t-aburasoba">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a class="social-icon" target="_blank" href="https://twitter.com/aburasobablog">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">I like to play BCG</span></div>
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Awards-->
            <section class="resume-section" id="thanks">
                <div class="resume-section-content">
                    <h2 class="mb-5">Thank you for installing!!</h2>
                    <ul class="fa-ul mb-0">
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            Slack での活動が活発になるような仕組みをどんどん開発していきます。ご要望等ございましたら <a href="https://twitter.com/aburasobablog" target="_blank">Twitter</a> からお問い合わせください。
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            アイデアをいただきました <a href="https://twitter.com/masagaogaoasia" target="_blank">Masagao</a> さんに感謝。
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </body>
</html>
