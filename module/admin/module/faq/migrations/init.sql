INSERT INTO `tbl_faq_category` (`faq_category_id`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1524161209, 1524161209),
(2, 1, 2, 1524161227, 1524161227),
(3, 1, 3, 1524161252, 1524161252),
(4, 1, 4, 1524161296, 1524161296);

INSERT INTO `tbl_faq_category_description` (`faq_category_id`, `language_id`, `name`) VALUES
(1, 2, 'China'),
(4, 2, 'Expenses'),
(3, 2, 'Rent'),
(2, 2, 'Work'),
(3, 1, 'Жильё'),
(4, 1, 'Затраты'),
(1, 1, 'Китай'),
(2, 1, 'Работа');

INSERT INTO `tbl_faq` (`faq_id`, `faq_category_id`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1524167536, 1524167605),
(2, 1, 1, 2, 1524167584, 1524167584),
(3, 1, 1, 3, 1524167662, 1524167662),
(4, 1, 1, 4, 1524167713, 1524167713),
(5, 1, 1, 5, 1524167774, 1524167774),
(6, 1, 1, 6, 1524167794, 1524167794),
(7, 2, 1, 7, 1524168230, 1524168241),
(8, 2, 1, 8, 1524168285, 1524168290),
(9, 2, 1, 9, 1524168323, 1524168393),
(10, 2, 1, 10, 1524168378, 1524168397),
(11, 3, 1, 11, 1524168448, 1524168456),
(12, 3, 1, 12, 1524168488, 1524168488),
(13, 4, 1, 13, 1524168549, 1524168558);

INSERT INTO `tbl_faq_description` (`faq_id`, `language_id`, `question`, `answer`) VALUES
(1, 1, 'Как быстро переводить деньги из Китая в Украину?', '<p>ESL Global является единственным оператором на рынке, который дает возможность своим клиентам не только зарабатывать, но и управлять своими средствами! .</p><p>C нашей помощью, Вы сможете легко отправлять деньги из Китая в Украину и наоборот, без надобности идти в банк для обмена валюты или же прибегать к услугам &quot;Western Union&rdquo; и &quot;Money Gramm&rdquo;. Данная услуга сэкономит вам кучу времени, нервов и денег!</p>'),
(1, 2, 'What shall i take with me?', '<p>We&rsquo;d suggest to take some bed linen and towels as most of provided apartments won&rsquo;t have that. A laptop, USB flash and some first aid kit medicine would be proper too.</p>'),
(2, 1, 'Визы и документы', '<p>Многие компании обещают сделать вам рабочие визы типа &laquo;Z&raquo; или же визы типа &laquo;L,M&raquo; с возможностью пребывания в Китае минимум 90 дней, не выезжая из страны. И все бы ничего, но есть официальное постановление министерства иностранных дел Китая (которое можно подтвердить в любом китайском посольстве) о том, что гражданам Украины, могут выдаваться бизнес визы типа &laquo;М&raquo;, сроком не более 45-60 дней пребывания в Китае, в зависимости от возраста и пола, а также туристические визы типа &laquo;L&raquo;, сроком не более 30 дней. А это значит, что при выборе такой визы, вам нужно будет покидать Китай каждый месяц-два. Естественно, за свой счет.<br />Касательно рабочих виз типа &laquo;Z&raquo; ситуация еще проще. С декабря 2015 года, для получения рабочей визы в сфере преподавания, вам необходим список документов, среди которых: сертификат TEFL/TESOL, диплом бакалавра, полученный в англоязычной стране (+ легализация этого диплома в китайском консульстве) как минимум 2 года релевантного опыта работы, справка о несудимости. И все, кто заявляет, что сделает вам эту визу в обход данного списка, скорее всего, не знаком с законодательством миграционных вопросов Китая или же просто пытается получить Ваши деньги и документы любой ценой.</p><p></p<p>Допустим, Ваш выбор был сделан в пользу предложения с визой типа &laquo;L&raquo; или &laquo;М&raquo;. Ваши грядущие расходы: выезд из Китая (ближайшее направление - Гонконг) минимум 6 раз в год. Билеты до Гонконга + проживание обойдутся в ~400$. Итого &mdash; минимум 2400$ вам придется тратить в течении каждого года, чтобы оставаться жить в Китае.</p><p>При выборе ESL Global в качестве своего оператора, все расходы ограничиваются единым платежом в размере 1300$. Без лишних стрессов и неудобств.</p><p><strong>Что предлагаем мы?</strong></p><p>&mdash; Легальную студенческую визу типа &laquo;Х2&raquo; со сроком пребывания в Китае минимум 180 дней (наиболее комфортный и удобный вариант для Украины).<br /&mdash; Бесплатное продление этой визы на аналогичный срок.<br /&mdash; Документальное подтверждение того, что вы являетесь студентом нашего партнерского ВУЗа, в случае, если это подтверждение потребуется.<br /Мы также можем предоставить пригласительное письмо на стажировку/обучение, которое может помочь в оформлении академотпуска или же увольнения с текущей работы.</p>'),
(2, 2, 'Chinese cuisine vs Western', '<p>You should consider a big difference between western and eastern food and the ways to cook it. Be ready that there is almost no dairy products or if there still is - it&rsquo;ll cost you a fortune. So it&rsquo;s better to get ready for soy milk, tofu and beans. But don&rsquo;t get frustrated too soon as there are lots of tasty, exotic and healthy dishes too. Wide range of fruits and fresh veggies that are available the whole year round! Prices would be much cheaper than European and the quality is no worse for sure. And of course, you&rsquo;ll have a chance to try the most famous Chinese street food! Snakes and scorpios BBQ, spiders and bugs? There&rsquo;s sure something you&rsquo;ll like.</p>'),
(3, 1, 'Что брать с собой?', '<p>Постельное белье и полотенца, медицина на случай простуды (акклиматизации) по прибытию, ноутбук, USB флеш-карта, 8 фотографий визового размера (для медосмотров, продления виз и прочего), оригинал диплома. Мы также, советуем взять теплые вещи, если вы собираетесь прилететь в осенне-зимний сезон. Некоторые этого не делают, думая, что в Китае все очень дешево и они с легкостью все купят по прибытию. Мы бы хотели развеять этот миф. В Китае действительно полно оптовых рынков с множеством вещей за копейки, но Вам вряд ли захочется это носить. Так что, не пожалейте места в чемодане и будете себе потом благодарны.</p>'),
(3, 2, 'How do i Google, Youtube and Facebook in China?', '<p>It&rsquo;s sadly true that since 2008 all the Google, Facebook, Youtube and Twitter platforms are blocked by Chinese officials. Luckily, there is a cure that called VPN. Using that tool you can use all the internet just as you used to. We&rsquo;ll sure help you to install one.</p>'),
(4, 1, 'Насколько отличается китайская кухня от нашей?', '<p>Отличие от привычной нам кухни, разумеется, присутствует. Достаточно острый дефицит молочных продуктов, таких как: сыр, творог, сметана, кефир. Зато есть много разных йогуртов, яиц и соевого молока в любом местном минимаркете. Колбасы и другие привычные нам мясные изделия можно найти разве что в импортных отделах. Местные предпочитают питаться вне дома, так как это вкусно и дешево. Будь то обед, ужин или завтрак, средняя стоимость не превысит 25 юаней за меню. Отдельные же блюда стоят по 5-10 юаней. Почти вся еда подается острой по умолчанию, однако, можно всегда предупредить официанта о вашем желании/нежелании добавлять специи. Большой выбор дешевых овощей и фруктов на любой вкус. Все фрукты имеются в наличии круглый год, независимо от сезона.</p>'),
(4, 2, 'How can i learn Chinese?', '<p>There are plenty of chances to master Mandarin while you live in China! One of the most popular ways is &ldquo;Language exchange partner&rdquo; . Good news - it&rsquo;s for free. It works on the mutual tutoring basis: you teach someone English and then they teach you Chinese in turn. This way is rather practical and also is a great chance to make new local friends. If you want to go more professional there are tones of language schools in town as well.</p>'),
(5, 1, 'Что делать с заблокированными интернет сервисами в Китае?', '<p>С 2008 года такие сайты, как: Youtube, Facebook, Twitter, Google и Instagram - не работают в Китае. Используйте VPN приложения: с их помощью можно просматривать любые сайты без ограничений. Мы поможем с поиском и установкой этих приложений.</p>'),
(5, 2, 'What to do with blocked internet services in China?', '<p> Since 2008, sites such as Youtube, Facebook, Twitter, Google and Instagram do not work in China. Use the VPN application: it allows you to view any site without restrictions. We will help you to find and install these applications.</p>'),
(6, 1, 'Могу ли я изучать китайский язык, участвуя в данной программе?', '<p>Конечно же можете! Один из самых популярных вариантов обучения &mdash; &laquo;language exchange&raquo; (партнер по языковому обмену). Такая форма изучения языка является абсолютно бесплатной и взаимовыгодной. Работает это так: Вы предлагаете свой русский или английский в обмен на китайский. К примеру, занятие идет два часа: первый час, преподавателем являетесь вы, второй час &mdash; являетесь студентом. Существует множество местных форумов посвященных этой теме, контакты которых мы с радостью предоставим. Вы можете подойти к вопросу более профессионально и найти настоящего репетитора-специалиста. Стоимость занятий один на один в среднем составляет 50-100 юаней/час в больших городах, 30-60 в городах поменьше. Занятия могут проходить в любые удобные для вас дни, утром или вечером. Следует помнить, что какой бы вариант изучения вы не выбрали, китайцы всегда будут очень воодушевлены и заинтересованы в обучении вас их языку!</p>'),
(6, 2, 'Can I learn Chinese by participating in this program?', '<p>Of course you can! One of the most popular learning options & mdash; & laquo; language exchange & raquo; (language exchange partner). This form of language learning is absolutely free and mutually beneficial. It works like this: you offer your Russian or English in exchange for Chinese. For example, the lesson is two hours: the first hour, you are the teacher, the second hour & mdash; you are a student. There are many local forums dedicated to this topic, whose contacts we will gladly provide. You can approach the question more professionally and find a real tutor specialist. The cost of classes one by one averages 50-100 yuan / hour in big cities, 30-60 in smaller cities. Classes can take place on any day convenient for you, in the morning or in the evening. It should be remembered that no matter what choice of study you choose, the Chinese will always be very enthusiastic and interested in teaching you their language!</p>'),
(7, 1, 'Как быстро я начинаю работать?', '<p>К моменту вашего прибытия, у нас уже есть несколько работодателей, заинтересованных конкретно в вас. Сроки утверждения на одну из этих вакансий зависят от успешности вашего демо урока. В некоторых случаях нам удается получить одобрение и утверждение со стороны школы еще до вашего приезда. В таком случае, мы заранее сообщаем, в какой именно город и школу вы попадете. Также, предоставляются фактические фото жилья и рабочего места.</p>'),
(7, 2, 'How soon do i start to work?', '<p>We normally would have quite a few schools already, before your arrival, particularly interested in you. In some cases you&rsquo;ll need to show the real demo lesson. Most of time we are able to fix the deal even before you come to China. In that case we&rsquo;ll provide you with actual school and apartment photos so that you can see where exactly you&rsquo;ll work and live.</p>'),
(8, 1, 'Что такое Демо урок?', '<p>Демо-урок &mdash; это показательный урок перед группой детей и руководством образовательного заведения. Как правило, демо-урок длится не более 10-15 минут. В группе может быть от 6 до 20 человек. Демо-урок нужен, чтобы оценить навыки преподавания и владения английским языком. Предварительно, мы подробно расскажем и покажем, как правильно и успешно пройти этот тест.</p>'),
(8, 2, 'What is the demo lesson?', '<p>It&rsquo;s a short performance (10-15 mins) that you need to do with kids as a sample of your teaching skills. There are usually 8-15 kids in one class. Certainly, we&rsquo;ll prepare you well for this test.</p>'),
(9, 1, 'Будет ли у меня отпуск?', '<p>Разумеется! Как правило, большинство учебных заведений закрывается во время государственных праздников Китая, (китайский новый год, день независимости Китая, день труда и прочие). Праздники могут длиться от одного дня до одного месяца, в зависимости от специфики учебного заведения. Стоит отметить, что не все каникулы являются оплачиваемыми. К примеру, в канун китайского нового года, некоторые садики и школы закрываются на целый месяц, однако, оплачивается только неделя или две.</p>'),
(9, 2, 'Will i have a vacation?', '<p>All the teachers would enjoy paid official Chinese holidays in accordance with the annual government schedule.</p>'),
(10, 1, 'Как я смогу учить китайских детей, не зная их языка?', '<p>С этим нет никаких проблем. Напротив, даже если бы вы знали китайский, вам бы не разрешалось использовать его в рабочее время. Задача иностранного преподавателя в том, чтоб погрузить свою группу в полностью англоязычную атмосферу. Речь не всегда может быть доходчивой, и в этом случае на помощь приходит &laquo;body language&raquo; &mdash; язык тела. Также, в вашей группе будет минимум 1 китайский учитель-ассистент, который поможет в трудностях перевода.</p>'),
(10, 2, 'How do a teach Chinese kids if i don\'t speak Chinese?', '<p>Easily! You don&rsquo;t have to speak Mandarin as it&rsquo;s forbidden anyway during your English lessons. Kids are supposed to be surrounded by English speaking atmosphere only. So you can feel free by using only English during your work time!</p>'),
(11, 1, 'Как снимать жилье в Китае?', '<p>Если вы решили выбрать вариант программы без жилья, то обратите внимание на специфику аренды жилья в Китае.<br /Существует всего лишь несколько англоязычных ресурсов, которые могли бы помочь в этом вопросе. Однако, цены там будут в 2-3 раза выше действительных. Большая часть объявлений приходится на китайские форумы и доски объявлений. Как правило, почти никто из хозяев не сдает жилье иностранцу напрямую. Вся сделка происходит через риелторские агентства, услуги которых, в Китае, оцениваются в один месяц стоимости жилья.<br /Средняя стоимость однокомнатной квартиры, составляет 3000-4000 юаней (450-600$) в месяц, в больших городах-мегаполисах, и 1500-2000 юаней (200-300$) в городах поменьше. Также, стоимость сильно колеблется в зависимости от выбранной части города. &laquo;Подвохом&raquo; в аренде китайского жилья является постоянная оплата наперед. К примеру, если вы решили снять квартиру, то заплатить придется за 3 месяца сразу + месяц депозита + риелторские услуги. Итого: 5 месяцев при первом платеже. Также, можно выбрать вариант не целой квартиры, а комнаты, подселившись к кому-то. В этом случае, можно будет избежать риэлторских услуг и договориться о постепенной оплате.</p>'),
(11, 2, 'How do i rent apartments in China?', '<p>If you decided to go with our Standard Package then you need to pay attention to some specific details of renting in China. There are just a few English websites that could help you with this. However, the prices there would be significantly more expensive than the actual renting cost. Most of advertisements are posted on various local Chinese web platforms and are, of course, all in Chinese. Normally, the locals would never rent anything to a foreigner directly, while they would use a middleman rental agency. Such agencies would charge you 1 month rent. Besides, you need to know that any rent in China starts from 3 months at least. Which means the first payment you&rsquo;ll need to make is: 3 months (renting fee) + 1 month (deposit) + 1 month (rental agency fee). 5 months in total. The monthly rent may vary from 4000 to 5000RMB (~750$) in big cities and 2000-3000RMB (~350$) in smaller ones. The price range depends a lot on a particular city area.</p>'),
(12, 1, 'Где я буду жить?', '<p>При выборе программы с жильем, вас поселят в квартиру недалеко от работы. В случае устройства в Пекине, предоставляется совместный тип проживания: &laquo;shared apartments&raquo;. Обычно, это 3-4ех комнатные квартиры с общей кухней и гостиной. Все такие квартиры оборудованы необходимой бытовой техникой и мебелью. У каждого участника есть своя личная комната под ключ. В случае устройства в других городах, не редко, могут предоставить и целую квартиру лично для вас (без соседей).<br /Помните, что постельное белье, подушку, одеяло и полотенце нужно взять с собой.</p>'),
(12, 2, 'Where will i live?', '<p>If you go with our regular Housing Package option you don&rsquo;t need to worry about any rental issues! In case of Beijing placement you&rsquo;ll be provided with a single room in shared apartments. All rooms are fully-equipped and have a locker. There are usually 3-4 rooms in the apartment with shared kitchen and living room. In case of placement in other cities it&rsquo;s more likely that you&rsquo;ll be given a single apartment just for yourself (non-shared).</p>'),
(13, 1, 'Сколько уходит на досуг и что сколько стоит?', '<p>Цены значительно ниже европейских и американских. Прожиточный минимум для иностранца составляет 2000-3000 юаней в месяц (~450$).</p><ul	<li>Метро: 3-7 юаней за проезд (в зависимости от дистанции поездки).</li>	<li>Автобусы: 2 юаня.</li>	<li>Такси: 13 юаней посадка, каждый последующий километр по 2.3 юаня. Поездка по городу - 20-30 юаней.</li>	<li>Обед в кафе/ресторане: 25-70 юаней.</li>	<li>Поход в супермаркет: 90-300 юаней. Диапазон цен зависит от того, где именно Вы закупаетесь. Иностранные сторы типа &laquo;Auchan, Carrefour, Walmart, BHG&raquo; - будут гораздо дороже местных, китайских маркетов.</li>	<li>Билет в кино: 30-120 юаней.</li>	<li>Билеты на поезда по Китаю: 50-500 юаней (в зависимости от направления и класса поезда).</li>	<li>Экскурсии и туры: 80-300 юаней за день.</li></ul'),
(13, 2, 'Leisure cost', '<ul>	<li>Metro: 3-7 yuan (depending on the route)</li>	<li>Busses: 1-2 yuan</li>	<li>Taxi: 13 yuan for entrance, 2.3 yuan/1km. Regular city ride would cost you around 20-30 yuan.</li>	<li>Lunch in a cafe/restaurant: 25-70 yuan</li>	<li>Grocery store: 90-300 yuan. The prices differ a lot between local Chinese stores and the foreign</li>	<li>ones (e.g. Auchan, BHG, Carrefour, Spar, Walmart etc.)</li>	<li>Cinema: 30-120 yuan</li>	<li>Intercity train: 50-500 yuan</li>	<li>Tours &amp; Excursions: 80-300 yuan per day.</li></ul>');
