import BlogComponent from './components/BlogComponent'
// import HeaderComponent from './components/HeaderComponent'
import ForumComponent from './components/ForumComponent'
import Document from './components/Document'
import CourseComponent from './components/CourseComponent'
import HomeComponent from './components/HomeComponent'
import ViewBlog from './components/ViewBlog'
import ViewForum from './components/ViewForum'
import CreateForum from './components/CreateForum'
import ViewCourse from './components/ViewCourse'
import MeCourse from './components/MeCourse'

export const routes = [
	{ path: '/blog', name: 'BlogComponent', component: BlogComponent },
	{ path: '/forum/create', name: 'CreateForum', component: CreateForum },
	{ path: '/forum', name: 'ForumComponent', component: ForumComponent },

	{ path: '/', name: 'HomeComponent', component: HomeComponent },
	{ path: '/blog/:id', name: 'ViewBlog', component: ViewBlog },
	{ path: '/forum/:id/:slug', name: 'ViewForum', component: ViewForum },
	{ path: '/document', name: 'Document', component: Document },
	{ path: '/me/course/', name: 'MeCourse', component: MeCourse },
	{ path: '/course', name: 'CourseComponent', component: CourseComponent },
	
	{ path: '/course/:id/:slug', name: 'ViewCourse', component: ViewCourse }


];