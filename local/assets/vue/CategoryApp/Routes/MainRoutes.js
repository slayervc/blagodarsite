import CategoryList from "./../Components/CategoryList/CategoryList.vue"
import CategoryItem from "./../Components/CategoryItem/CategoryItem.vue"

const ROUTES = [
	{path: '/', component: CategoryList},
	{path: '/category/:id', name: 'category', component: CategoryItem}
	
]

export {ROUTES};

