<script setup>
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

defineProps({
    products: Array
})

const form = useForm({
    name: '',
    price: '',
    category: ''
})

const submit = () => {
    form.post('/products', {
        onSuccess: () => form.reset()
    })
}

const deleteProduct = (id) => {
    form.delete(`/products/${id}`)
}
</script>

<template>
<div class="min-h-screen bg-gray-100 p-8">

    <div class="max-w-5xl mx-auto">

        <!-- Title -->
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-800">Product Management</h1>
             <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition">
                <Link 
                    :href="route('dashboard')" 
                    class="text-blue-500 hover:text-blue-700 transition"
                >
                    Back to Dashboard
                </Link>  
             </button>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-md rounded-xl p-6 mb-8">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">
                Add Product
            </h2>

            <form @submit.prevent="submit" class="grid md:grid-cols-4 gap-4">

                <input 
                    v-model="form.name" 
                    placeholder="Name Product"
                    class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 outline-none"
                />

                <input 
                    v-model="form.price" 
                    placeholder="Price"
                    type="number"
                    class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 outline-none"
                />

                <input 
                    v-model="form.category" 
                    placeholder="Category"
                    class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 outline-none"
                />

                <button 
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 transition text-white font-semibold rounded-lg px-4 py-2 disabled:opacity-50"
                    :disabled="form.processing"
                >
                    {{ form.processing ? 'Saving...' : 'Add' }}
                </button>

            </form>
        </div>

        <!-- Product List -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">
                Product List
            </h2>

            <div v-if="products.length === 0" class="text-gray-500 text-center py-6">
                No products available
            </div>

            <div v-else class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-3">Name</th>
                            <th class="p-3">Price</th>
                            <th class="p-3">Category</th>
                            <th class="p-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr 
                            v-for="product in products" 
                            :key="product.id"
                            class="border-b hover:bg-gray-50 transition"
                        >
                            <td class="p-3 font-medium text-gray-800">
                                {{ product.name }}
                            </td>

                            <td class="p-3 text-gray-600">
                                Rp {{ product.price }}
                            </td>

                            <td class="p-3 text-gray-600">
                                {{ product.category }}
                            </td>

                            <td class="p-3 text-center">
                                <button 
                                    @click="deleteProduct(product.id)" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
</template>