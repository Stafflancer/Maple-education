INSERT INTO `tbl_banner` (`banner_id`, `name`, `status`) VALUES
(1, 'Отзызы (Олег)', 1),
(2, 'Отзывы (Александра)', 1),
(3, 'Отзывы (Настя)', 1),
(4, 'Отзывы (Оксана)', 1),
(5, 'Отзывы (Ксения)', 1),
(6, 'Отзывы (Даша)', 1),
(7, 'Отзывы (Игорь и Оля)', 1),
(8, 'Отзывы (Артём)', 1);

INSERT INTO `tbl_banner_image` (`banner_image_id`, `banner_id`, `language_id`, `title`, `link`, `image`, `sort_order`) VALUES
(1, 1, 1, 'Banner 1', '', '357d8ad05118021edee49ebb4b3f5b8a.jpeg', 1),
(2, 1, 1, 'Banner 2', '', '4ff6a5c5a24565cb706ba0228be27153.jpeg', 2),
(3, 1, 1, 'Banner 3', '', 'ef66401276c7472a676875444766beea.jpeg', 3),
(4, 1, 1, 'Banner 4', '', '9f5131a3261bcf7b7b0fa8ba3e24b849.jpeg', 4),
(5, 2, 1, 'Banner 1', '', '76684fe7542a3988015cd2502d9d8412.jpeg', 1),
(6, 2, 1, 'Banner 2', '', '0511a8ed7e65a077aca9f9c029eb44df.jpeg', 1),
(7, 2, 1, 'Banner 3', '', 'df3b7fd98dec28cd16bbce21317f89a2.jpeg', 1),
(8, 2, 1, 'Banner 4', '', '173abbbd17bfb0b5838a499d2fa90635.jpeg', 1),
(9, 3, 1, 'Banner 1', '', 'd7f465570ca5a972f43c08d23daa5287.jpg', 1),
(10, 3, 1, 'Banner 2', '', 'e5f9f8882e4cb623d50db0db22684057.jpg', 1),
(11, 3, 1, 'Banner 3', '', 'dbc5fe6cec492df5b41565221dba443d.jpg', 1),
(12, 3, 1, 'Banner 4', '', '9557fb131b46e7357b36cc5f3c7df377.jpg', 1),
(13, 3, 1, 'Banner 5', '', '2282ac6dc9e272ea4a8ab2f4833393ae.jpg', 1),
(14, 4, 1, 'Banner 1', '', '64333d4f5870df15ca097db34b3e0913.jpeg', 1),
(15, 4, 1, 'Banner 2', '', 'ef7b4eb5dc084b034bb625a3e896f3ed.jpeg', 1),
(16, 4, 1, 'Banner 3', '', '975e00dfdfe85d117ea4f17002a66ad1.jpeg', 1),
(17, 4, 1, 'Banner 4', '', 'f984a938759cd37c5c5d63001d48f3d6.jpeg', 1),
(18, 5, 1, 'Banner 1', '', 'd3c7182fb901b9ecbed4841bcee992d0.jpeg', 1),
(19, 5, 1, 'Banner 2', '', '4ce93b62152e635b89692f585dec1438.jpeg', 1),
(20, 5, 1, 'Banner 3', '', '9483bd3b782512ead74f7042cbd85e14.jpeg', 1),
(21, 5, 1, 'Banner 4', '', '08673c163d5923c91111e9d828010ebf.jpeg', 1),
(22, 5, 1, 'Banner 5', '', '81ab72cbecd48f13ef787a081708a87c.jpeg', 1),
(23, 6, 1, 'Banner 1', '', '7852b072f655fcc28d93d69125306fd8.jpeg', 1),
(24, 6, 1, 'Banner 2', '', 'ff65786b11ab4b6241e51d2e5fe05ffb.jpeg', 1),
(25, 6, 1, 'Banner 3', '', '692205207923f8bad371b918ca870123.jpeg', 1),
(26, 7, 1, 'Banner 1', '', '747d36b25bb43a93de205a8af2929e16.jpeg', 1),
(27, 7, 1, 'Banner 2', '', '439af74489d36a3d5d040720036921d5.jpeg', 1),
(28, 7, 1, 'Banner 3', '', '44d9ab62c55e98b38bc50f1b3257665f.jpeg', 1),
(29, 7, 1, 'Banner 4', '', '9621a3cf96c203e6cc69f310cd578116.jpeg', 1),
(30, 8, 1, 'Banner 1', '', '8d4f1d444bcbd5a3cda5e38c8fb0b17b.jpeg', 1),
(31, 8, 1, 'Banner 2', '', 'ff74e9a1d27008263c74555c9f38f33e.jpeg', 1),
(32, 8, 1, 'Banner 3', '', '79e12573e414221b3f6b1c58aeea2e09.jpeg', 1);

INSERT INTO `tbl_review` (`review_id`, `banner_id`, `image`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'e114f4a1cd92ed59ee59b893864c99b6.jpeg', 1, 1, 1524128312, 1524130113),
(2, 2, 'ec2226752455c9961fdcdfa9906c3725.jpeg', 1, 2, 1524130303, 1524130303),
(3, 3, 'eaa76909d55a10272c808ae007f53834.jpg', 1, 3, 1524130375, 1524130375),
(4, 4, 'd3720f43b0567b14b8bb177ef8f1aed8.jpeg', 1, 4, 1524130440, 1524130440),
(5, 5, '91d38c1cbf50d47bb383e043a18871b6.jpg', 1, 5, 1524130493, 1524130493),
(6, 6, 'e13237be5823641dda4bb51fefcaf125.jpeg', 1, 6, 1524130551, 1524130551),
(7, 7, 'a609af626e7089bc04312916e5c3d72c.jpeg', 1, 7, 1524130636, 1524130636),
(8, 8, '47b42b7bda8911d589b1227fcedd675c.jpeg', 1, 8, 1524130693, 1524130693);

INSERT INTO `tbl_review_description` (`review_id`, `language_id`, `author`, `title`, `text`) VALUES
(1, 1, 'Олег', 'В Китай попал из-за безвыходности, в связи с резко обострившейся ситуацией в Украине.', 'Не было никакой надежды на родной город и место, где работал ранее. К счастью, в интернете наткнулся на данную программу «ESL Global» и очень загорелся этой идеей. По приезду, очень повезло со школой и соседями по жилью. Жизнь заметно наладилась и появилась возможность помогать родным и близким, оставшимся дома. Спасибо за предоставленный шанс!'),
(1, 2, 'John', 'Got a chance - a crime to waste.', 'I’ve come to China as there were not so many chances to develop and simply make ends meet in my home country. Here, i’ve gotten lots of positivity, new knowledge and a great potential to grow as mentally as professionally. Thanks a lot to ESL Global for giving me such a life time opportunity.'),
(2, 1, 'Александра', 'Я мечтала о переменах и я их получила!', 'Пожалуй, Китай — мое первое глобальное решение и свежий шаг в новую жизнь. Чувствую себя здесь абсолютно счастливым и полноценным человеком. Пекин подарил мне другую жизнь, новых друзей и прекрасное расположение духа. Спасибо команде «ESL Global» за возможность быть тут. Теперь, благодаря им, каждый может улучшить свой материальный уровень жизни, а так же обрести бесценный опыт и испытать незабываемые эмоции.'),
(2, 2, 'Sasha', 'I dreamed of changes and i’ve made it!', 'Ironically, my way to China happened to be by an absolute coincidence! However, yet, it’s the best thing that ever happened to me. Tones of fun every day with kids, being recognized as a “move star” anywhere you go and just being treated so well all the time. I am grateful to be here. ESL Global is a big pleasure to cooperate with.'),
(3, 1, 'Настя', 'Выражаю искреннюю благодарность компании «ESL Global» за кардинальные перемены в моей жизни.', 'Мне приятно работать с профессионалами своего дела и просто с хорошими людьми. Я всегда знаю, что не останусь без помощи и поддержки, и могу быть уверена в своих начинаниях, живя в Китае. Надеюсь и на дальнейшее плодотворное сотрудничество.'),
(3, 2, 'Stacy', 'I applied for this program with quite a doubt but in just 2 weeks already i landed in Beijing!', 'Many thanks to ESL Global for finally getting me here. It sometimes comes as a great challenge to get out of your comfort zone. But once you do - you know that it was the only reasonable decision. And i am very glad that i made this decision as life just got much brighter and happier. If there is any obstacle on your way to here - overcome it!'),
(4, 1, 'Оксана', 'Спасибо «ESL Global» за прекрасную возможность увидеть мир и получить бесценный опыт.', 'Думаю, что у всех в жизни наступает такой момент, что хочется что-то колоссально изменить. Такой этап был и у меня, я решила рискнуть, хотя ранее даже мыслей не было ехать именно в Китай. Безусловно, я слышала много отзывов о жизни там, но все они в значительной мере отличались друг от друга. Скажу одно: приехав сюда , увидев всю жизнь изнутри я была более чем счастлива, поскольку ты попадаешь в абсолютно другой мир, с иной культурой , восприятием мира и стилем жизни. Кто хочет реализации, получения новых эмоций - вам сюда! Ребята работают очень слаженно, начиная с оформления документов и до помощи во всевозможных вопросах и жизни в Китае. Как для меня, это является большим плюсом, поскольку приехав ты находишься в шоке от того что вообще происходит, ребята оказывают поддержку во всех случаях. Спасибо вам большое!'),
(4, 2, 'Sana', 'Great experience, good value.', 'I guess there is a period in everyone’s life when one is eager for changes. So was i when considered to apply for this program. Everything turned out to be pretty well. I have been enjoying every day here, simply because it’s all so new and somehow matches me in a right way. Working with kids is a big pleasure as they are the purest creatures in the world.'),
(5, 1, 'Ксения', 'Мне всегда хотелось пожить в другой стране.', 'Не «забежать в гости» как турист, а по-настоящему узнать чужой быт, традиции, привычки, почувствовать вкус другой реальности. Такую возможность мне предоставила команда «ESL Global», за что я ей очень благодарна! Теперь я живу в столице Поднебесной, постоянно общаюсь с иностранными коллегами, работаю с детками, получаю за это достойные деньги и радуюсь каждому дню.'),
(5, 2, 'Roxy', 'I’ve always wanted to live in a foreign country', 'As I\'d been seeking for jobs in various countries i always thought that eventually i’ll end up somewhere in South America or Spain. Therefore it came as a big surprise when after all i got to China! Luckily, the country overwhelmed me so much as nothing else before. People are weird but funny, the urban scene is amazing and oh, my job is wonderful too!'),
(6, 1, 'Даша', 'Обратилась в компанию “ESL Global” с целью поиска работы за рубежом, но я и не ожидала, что моя жизнь изменится менее, чем за две недели.', 'Ребята действительно профессионалы своего дела, консультировали по всем вопросам, оказали огромную поддержку по прилету в Китай. Это программа гарантирует интересную работу, достойный заработок, визовую поддержку, предоставление комфортного жилья, а также возможности путешествовать и развиваться. Хочу сказать компании “ESL Global” огромное спасибо за предоставленную возможность!'),
(6, 2, 'Amy', 'China as nowhere else', 'The most incredible country I have ever been to. So much is different and it just feels so right to me. I am glad to work with real professionals and just good people. I know that i am always supported and treated fairly, no matter what. Looking forward to a long a fruitful cooperation.'),
(7, 1, 'Игорь и Оля', 'Большое спасибо ESL Global за возможность посетить Азию и заработать.', 'Мы очень долго выбирали компанию: читали отзывы, сравнивали положительные и отрицательные стороны, общались с ребятами которые уже в Китае. И очень рады, что приехали с помощью ESL Global. Мы ни разу не пожалели, что выбрали именно это агенство. Как только прошли собеседование нам сразу быстро оформили визу аж на полгода, хотя все остальные в Украине обещают максимум 60 дней (!!!) и мы купили билеты. Работу и жилье предоставили также, согласно оговоренному. Ну, а работа просто замечательная. Детки очень добрые и китайские ассистенты очень дружелюбны и открыты. Если у вас есть возможность приехать в Китай, то вы уже никогда не захотите обратно!!!'),
(7, 2, 'Harry and Olie', 'It’s cool to be here, in the very heart of Asia', 'We had almost no knowledge about China before coming here. It was a far, mysterious land with nothing familiar we could possibly think of. I’d say our decision to try this on was caused by the great intrigue and curiosity. And now, after almost a year here i can firmly say that the curiosity was totally fulfilled and all the worries paid off! Extra thanks to ESL Global guys for leading us in many aspects of quite confusing and sometimes odd issues, here in China!'),
(8, 1, 'Артём', 'Искренне благодарю команду \"ESL Global\" за качество и скорость работы.', 'Спустя месяц после моего первого звонка в компанию, я уже активно работаю и живу счастливой жизнью в одном из самых прекрасных мест на Земле. Подобная работа требует творчества, воображения и отсутствия каких-либо комплексов. Люди здесь невероятно открытые и радушные, за 1 месяц жизни в Китае я нашёл настолько хороших и близких друзей, каких не было за все прошлые годы в Украине. Будучи человеком самостоятельным, не могу не отметить, насколько помогает ощущение профессиональной и своевременной поддержки со стороны представителей в любых вопросах.'),
(8, 2, 'Adam', 'What a country, worth a visit!', 'Just in less than a month after my application I\'ve landed in Beijing. In just 4 days I\'ve signed a contract and started to work! I have already had some ESL teaching experience so the job appeared to be even more pleasant than i expected! Kind and polite local coworkers, flexible schedule and quite a fair pay.. What else one can dream of?');
