<?php

namespace App\Http\Controllers;

use App\Models\Suit;
use App\Traits\SuitTrait;
use Illuminate\Http\Request;

class SuitController extends Controller
{
    use SuitTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
//         $allowFilters= ['name', 'description', 'fabric_name', 'type_id', 'start_date'];
//         $filters = $request->only($allowFilters);
// $query = Suit::query();

// // Apply filters dynamically
// foreach ($filters as $key => $value) {
//     // Check if the value is not empty and the key exists in the table columns
//     if (!empty($value) && in_array($key, $allowFilters)) {
//         // Add where clause based on the key and value
//         if($key == 'start_date'){
//             $query->whereDate("created_at", '>=', $value);
//         }else {

//             $query->where($key, 'like', '%' . $value . '%');
//         }
//     }
// }

// // Execute the query and retrieve the results
// $suits = $query->get();
//     return response()->json(['data' => $suits]);

        $suits = Suit::all();
        // return response()->json(['data' => $suits]);
        return view('suits.index', ['suits' => $suits]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image.*'=> 'required|image|mimes:jpeg,png,jpg',
            'fabric_name' => 'required',
            'type_id' => 'required',

        ]);
        $imageName = time().'_'.$request->user()->id.$request->image->getClientOriginalName();
        $request->image->move(public_path('images'),$imageName);
        $suit = Suit::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'fabric_name' => $request->fabric_name,
            'type_id' => $request->type_id,
            'user_id' => $request->user()->id,
        ]);
        // return response()->json(['data' => $suit]);
        return redirect()->route('suits.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suit = Suit::find($id);
        if($suit){
            // return response()->json(['data' => $suit]);
            return redirect()->route('suits.show',['suit' => $suit]);
        }
        // return response()->json(['message' => 'Suit not found'], 404);
        return redirect()->route('suits.indes',['message' => 'Suit not found'], 404);
    }

    /**
     * the code in this method is the same of method below (updateSuit) 
     * but i do not know why patch and put method does not work when send the data with multi part form data
     * would you explain that to me
     */
    public function update(Request $request, string $id)
    {
        // $suit = Suit::find($id);
        // if($suit){
        //     $suit->name = $request->name ?? $suit->name;
        //     $suit->description = $request->description ?? $suit->description;
        //     $suit->fabric_name = $request->fabric_name ?? $suit->fabric_name;
        //     $suit->type_id = $request->type_id ?? $suit->type_id;

        //     if($request->hasFile('image')){
        //         $imageName = time().'_'.$request->user()->id.$request->image->getClientOriginalName();
        //         $request->image->move(public_path('images'),$imageName);
        //         $suit->image = $imageName ;
        //         return response()->json(['data' => $suit]);
        //     }
            
        //     $suit->update();
        //     return response()->json(['data' => $suit]);
        // }
        // return response()->json(['message' => 'Suit not found'], 404);
    }
    public function updateSuit(Request $request , string $id)
    {
        
        $suit = Suit::find($id);
        if($suit){
            $suit->name = $request->name ?? $suit->name;
            $suit->description = $request->description ?? $suit->description;
            $suit->fabric_name = $request->fabric_name ?? $suit->fabric_name;
            $suit->type_id = $request->type_id ?? $suit->type_id;

            if($request->hasFile('image')){
                $imageName = time().'_'.$request->user()->id.$request->image->getClientOriginalName();
                $request->image->move(public_path('images'),$imageName);
                $suit->image = $imageName ;
                
            }
            
            $suit->update();
            // return response()->json(['data' => $suit]);
            return redirect()->route('suits.index',['messsage' => 'Suit updated']);
        }
        // return response()->json(['message' => 'Suit not found'], 404);
        return redirect()->route('suits.index',['message' => 'Suit not found'], 404);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suit = Suit::find($id);
        if($suit){
            $suit->delete();
            // return response()->json(['message' => 'Suit deleted']);
            return redirect()->route('suits.index',['messsage' => 'Suit deleted']);
        }
        // return response()->json(['message' => 'Suit not found'], 404);
        return redirect()->route('suits.index',['message' => 'Suit not found'], 404);
    }
}
