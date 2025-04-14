<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a paginated list of blogs.
     */
    public function index()
    {
        $blogs = Blog::with('category')->paginate(10); // Include category relationship
        return response()->json($blogs, 200);
    }

    /**
     * Display a single blog by ID.
     */
    public function show($id)
    {
        $blog = Blog::with('category')->find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        return response()->json($blog, 200);
    }

    /**
     * Store a new blog.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug',
            'category_id' => 'required|exists:blog_categories,id',
            'content' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|max:260',  // Adjust the max size as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the blog
        $blog = Blog::create($request->all());

        return response()->json(['message' => 'Blog created successfully', 'data' => $blog], 201);
    }

    /**
     * Update an existing blog.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|unique:blogs,slug,' . $id,
            'category_id' => 'sometimes|exists:blog_categories,id',
            'content' => 'sometimes|string',
            'description' => 'nullable|string',
            'image' => 'nullable|max:260',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update the blog
        $blog->update($request->all());

        return response()->json(['message' => 'Blog updated successfully', 'data' => $blog], 200);
    }

    /**
     * Delete a blog.
     */
    public function delete($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $blog->delete();

        return response()->json(['message' => 'Blog deleted successfully'], 200);
    }
}
