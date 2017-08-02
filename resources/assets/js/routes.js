import Postback from './components/Bot/Postback'
import Postbackview from './components/Bot/PostbcakView'
import Login from './components/Auth/Login'
import Register from './components/Auth/Register'

import ProductsList from './components/Products/ProductsList'
import ProductRemove from './components/Products/ProductRemove'
import ProductEdit from './components/Products/ProductEdit'

import Menus from './components/Menus/Menu'
import MenuView from './components/Menus/MenuView'

import SuggestionsList from './components/Suggestions/SuggestionList'

import NotFoundPage from './components/NotFoundPage'

export default [
  { path: '/', component: Postback, meta: { requiresAuth: true } },

  { path: '/login', component: Login, meta: { requiresAuth: false } },
  { path: '/register', component: Register, meta: { requiresAuth: false } },

  { path: '/postback/:id', component: Postbackview, meta: { requiresAuth: true } },

  { path: '/products', component: ProductsList, meta: { requiresAuth: true } },
  { path: '/product/:id/edit', component: ProductEdit, meta: { requiresAuth: true } },
  { path: '/product/:id/remove', component: ProductRemove, meta: { requiresAuth: true } },

  { path: '/menus', component: Menus, meta: { requiresAuth: true } },
  { path: '/menu/:id', component: MenuView, meta: { requiresAuth: true } },

  { path: '/suggestions', component: SuggestionsList, meta: { requiresAuth: true } },

  { path: '*', component: NotFoundPage, meta: { requiresAuth: false } },
]