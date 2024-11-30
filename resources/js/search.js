import instantsearch from 'instantsearch.js';
import 'instantsearch.css/themes/reset.css';
import 'instantsearch.css/themes/satellite.css';
import { searchBox, sortBy, pagination, refinementList, hits, stats } from 'instantsearch.js/es/widgets';
import TypesenseInstantSearchAdapter from 'typesense-instantsearch-adapter';

const localeMap = {
  en: {
    'cover.types.book': 'Book',
    'cover.types.verse': 'Verse',
    'genres.fantasy': 'Fantasy',
    'genres.science_fiction': 'Science Fiction',
    'genres.post_apocalyptic': 'Post-Apocalyptic',
    'genres.dystopia': 'Dystopia',
    'genres.cyberpunk': 'Cyberpunk',
    'genres.steampunk': 'Steampunk',
    'genres.solarpunk': 'Solarpunk',
    'genres.alternative_history': 'Alternative History',
    'genres.dark_fantasy': 'Dark Fantasy',
    'genres.epic_fantasy': 'Epic Fantasy',
    'genres.urban_fantasy': 'Urban Fantasy',
    'genres.ethnic_fantasy': 'Ethnic Fantasy',
    'genres.fairy_tale': 'Fairy Tale',
    'genres.horror': 'Horror',
    'genres.mystic': 'Mystic',
    'genres.adventure': 'Adventure',
    'genres.action': 'Action',
    'genres.detective': 'Detective',
    'genres.thriller': 'Thriller',
    'genres.space_fantasy': 'Space Fantasy',
    'genres.space_opera': 'Space Opera',
    'genres.social_fantasy': 'Social Fantasy',
    'genres.crypto_history': 'Crypto-History',
    'genres.biopunk': 'Biopunk',
    'genres.superhero': 'Superheroes',
    'genres.historical_fantasy': 'Historical Fantasy',
    'genres.cossack_fantasy': 'Cossack Fantasy',
    'genres.techno_fantasy': 'Techno Fantasy',
    'genres.noir': 'Noir',
    'genres.neonoir': 'Neo-Noir',
    'genres.romance': 'Romance',
    'genres.modern_romance': 'Modern Romance',
    'genres.romantic': 'Romantic',
    'genres.erotic': 'Erotica',
    'genres.free_verse': 'Free Verse',
    'genres.self_development': 'Self-Development',
    'genres.popular_science': 'Popular Science',
    'genres.legal_literature': 'Legal Literature',
    'cover.statuses.in_progress': 'In progress',
    'cover.statuses.completed': 'Completed',
    'languages.ukrainian': 'Ukrainian',
    'languages.english': 'English',
    Featured: 'Featured',
    'Most liked': 'Most liked',
    'Least liked': 'Least liked',
    'Most viewed': 'Most viewed',
    'Least viewed': 'Least viewed',
    New: 'New',
    Old: 'Old',
    placeholder: 'Titles, descriptions or authors',
  },
  uk: {
    'cover.types.book': 'Книга',
    'cover.types.verse': 'Вірш',
    'genres.fantasy': 'Фентезі',
    'genres.science_fiction': 'Наукова фантастика',
    'genres.post_apocalyptic': 'Постапокаліпсис',
    'genres.dystopia': 'Дистопія',
    'genres.cyberpunk': 'Кіберпанк',
    'genres.steampunk': 'Стимпанк',
    'genres.solarpunk': 'Соларпанк',
    'genres.alternative_history': 'Альтернативна історія',
    'genres.dark_fantasy': 'Темне фентезі',
    'genres.epic_fantasy': 'Епічне фентезі',
    'genres.urban_fantasy': 'Міське фентезі',
    'genres.ethnic_fantasy': 'Етнічне фентезі',
    'genres.fairy_tale': 'Казка',
    'genres.horror': 'Жахи',
    'genres.mystic': 'Містика',
    'genres.adventure': 'Пригоди',
    'genres.action': 'Екшн',
    'genres.detective': 'Детектив',
    'genres.thriller': 'Трилер',
    'genres.space_fantasy': 'Космічне фентезі',
    'genres.space_opera': 'Космічна опера',
    'genres.social_fantasy': 'Соціальне фентезі',
    'genres.crypto_history': 'Криптоісторія',
    'genres.biopunk': 'Біопанк',
    'genres.superhero': 'Супергерої',
    'genres.historical_fantasy': 'Історичне фентезі',
    'genres.cossack_fantasy': 'Козацьке фентезі',
    'genres.techno_fantasy': 'Технофентезі',
    'genres.noir': 'Нуар',
    'genres.neonoir': 'Неонуар',
    'genres.romance': 'Романтика',
    'genres.modern_romance': 'Сучасна романтика',
    'genres.romantic': 'Романтичний',
    'genres.erotic': 'Еротика',
    'genres.free_verse': 'Вільний вірш',
    'genres.self_development': 'Саморозвиток',
    'genres.popular_science': 'Популярна наука',
    'genres.legal_literature': 'Юридична література',
    'languages.ukrainian': 'Українська',
    'languages.english': 'Англійська',
    Featured: 'Рекомендовані',
    'Most liked': 'Найбільше вподобані',
    'Least liked': 'Найменше вподобані',
    'Most viewed': 'Найбільше переглянуті',
    'Least viewed': 'Найменше переглянуті',
    New: 'Нові',
    Old: 'Старі',
    placeholder: 'Назви, опис творів або автори',
  },
};

const statsText = {
  en: `
        {{#hasNoResults}}No results{{/hasNoResults}}
        {{#hasOneResult}}1 result{{/hasOneResult}}
        {{#hasManyResults}}{{#helpers.formatNumber}}{{nbHits}}{{/helpers.formatNumber}} results{{/hasManyResults}}
        found in {{processingTimeMS}}ms
      `,
  uk: `
        {{#hasNoResults}}Немає результатів{{/hasNoResults}}
        {{#hasOneResult}}1 результат{{/hasOneResult}}
        {{#hasManyResults}}{{#helpers.formatNumber}}{{nbHits}}{{/helpers.formatNumber}} результатів{{/hasManyResults}}
        знайдено за {{processingTimeMS}}мс
      `,
};

function startSearch(locale, apiKey, host, port, protocol) {
  const __ = localeMap[locale];

  const additionalSearchParameters = {
    query_by: 'title,description,authors',
  };

  const typesenseInstantsearchAdapter = new TypesenseInstantSearchAdapter({
    server: {
      connectionTimeoutSeconds: 10000,
      apiKey: apiKey,
      nodes: [
        {
          host: host,
          port: port,
          protocol: protocol,
        },
      ],
    },
    additionalSearchParameters,
  });
  const searchClient = typesenseInstantsearchAdapter.searchClient;
  const search = instantsearch({
    searchClient,
    indexName: 'cover_index',
    routing: true,
  });

  // ============ Begin Widget Configuration
  search.addWidgets([
    searchBox({
      container: '#searchbox',
      placeholder: __['placeholder'],
      autofocus: true,
    }),
    sortBy({
      container: '#sort-by',
      items: [
        { label: __['Featured'], value: 'cover_index' },
        { label: __['Most liked'], value: 'cover_index/sort/likes:desc' },
        { label: __['Least liked'], value: 'cover_index/sort/likes:asc' },
        { label: __['Most viewed'], value: 'cover_index/sort/unique_views:desc' },
        { label: __['Least viewed'], value: 'cover_index/sort/unique_views:asc' },
        { label: __['New'], value: 'cover_index/sort/created_at:desc' },
        { label: __['Old'], value: 'cover_index/sort/created_at:asc' },
      ],
    }),
    pagination({
      container: '#pagination',
    }),
    refinementList({
      container: '#genres-refinement-list',
      attribute: 'genres',
      operator: 'or',
      limit: 10,
      showMore: true,
      transformItems(items) {
        return items.map((item) => ({
          ...item,
          highlighted: __[item.highlighted],
        }));
      },
    }),
    refinementList({
      container: '#authors-refinement-list',
      attribute: 'authors',
      operator: 'or',
      limit: 10,
      showMore: true,
      searchable: true,
    }),
    refinementList({
      container: '#language-refinement-list',
      attribute: 'language',
      operator: 'and',
      limit: 10,
      transformItems(items) {
        return items.map((item) => ({
          ...item,
          highlighted: __[item.highlighted],
        }));
      },
    }),
    refinementList({
      container: '#cover-type-refinement-list',
      attribute: 'cover_type',
      operator: 'and',
      limit: 10,
      transformItems(items) {
        return items.map((item) => ({
          ...item,
          highlighted: __[item.highlighted],
        }));
      },
    }),
    hits({
      container: '#hits',
      templates: {
        item(item) {
          console.log(item);
          return `
  <div class='min-w-56 max-w-56'>
    <a href="/books/${item.id}">
      <div class="relative">
        <img
          width="100%"
          height="100%"
          class="rounded-lg object-cover"
          src="/blank-224X320.webp"
        />
  
        <div class="inline-block rounded-[4px] px-[8px] py-[6px] absolute bottom-2 left-2 bg-surface-1">
          <p class="p-base">${__[item.cover_type]}</p>
        </div>
      </div>
      <p class="mt-2 font-medium hit-title p-2xl">${item._highlightResult.title.value}</p>
    </a>
    <p class="text-on-background-2 hit-authors p-base">${item._highlightResult.authors[0].value}</p>
    <p class="mt-2 hit-description line-clamp-2 p-base">${item._highlightResult.description == null ? '' : item._highlightResult.description.value}</p>
  </div>
        `;
        },
      },
    }),
    stats({
      container: '#stats',
      templates: {
        text: statsText[locale],
      },
    }),
  ]);

  search.start();
}

window.startSearch = startSearch;
